<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php include 'content.php'; ?>
<h1>Omah</h1>
<div class="row">
  <div class="col-md-6">
    <div id="chartContainer"></div>

  </div>
  <div class="col-md-6">

    <div id="chartContainer2"></div>
  </div>
</div>


<?php
$conn = mysqli_connect('localhost', 'root', '');
if (!$conn) {
    die('<div class="alert alert-danger" style="margin:1%;">Could not connect to the database. Set Database Username and Password in the file "/how-to/data-from-database.php"</div>');
}
$selected_database = mysqli_select_db($conn, "cobaevelyn");
if (!$selected_database) {
    die('<div class="alert alert-danger" style="margin:1%;">Required database does not exist. Please import the canvasjs_db.sql file in the downloaded zip package '
            . '(<a href="https://www.digitalocean.com/community/tutorials/how-to-import-and-export-databases-and-reset-a-root-password-in-mysql" target="_blank">Instructions to Import.</a>).</div>');
}

$query = "select AVG(tugas) as tugas,AVG(uts) as uts ,AVG(uas) as uas from cerdasbisnis";
$data = mysqli_query($conn, $query);
$dataPoints = array();


while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
    array_push($dataPoints, $row);
}


// print json_encode($dataPoints);
?>

<?php
$conn = mysqli_connect('localhost', 'root', '');
if (!$conn) {
    die('<div class="alert alert-danger" style="margin:1%;">Could not connect to the database. Set Database Username and Password in the file "/how-to/data-from-database.php"</div>');
}
$selected_database = mysqli_select_db($conn, "cobaevelyn");
if (!$selected_database) {
    die('<div class="alert alert-danger" style="margin:1%;">Required database does not exist. Please import the canvasjs_db.sql file in the downloaded zip package '
            . '(<a href="https://www.digitalocean.com/community/tutorials/how-to-import-and-export-databases-and-reset-a-root-password-in-mysql" target="_blank">Instructions to Import.</a>).</div>');
}

$query = "select AVG(tugas) as tugas,AVG(uts) as uts ,AVG(uas) as uas from basisdata";
$data = mysqli_query($conn, $query);
$dataPointsBD = array();


while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
    array_push($dataPointsBD, $row);
}


// print json_encode($dataPoints);
?>


<script type="text/javascript">
   var stuff = <?php print json_encode($dataPoints); ?>;
   var stuffBD = <?php print json_encode($dataPointsBD); ?>;

label=[];
value=[];
i=0
//value and label split push 1
for (key in stuff[0]) {
    
  if (stuff[0].hasOwnProperty(key)) {
    // console.log(key);
    label.push(key);
    // console.log(stuff[0][key]);
    value.push(stuff[0][key]);
  }
  i=i+1;
}

labelBD=[];
valueBD=[];

i=0
//value and label split push 2
for (key in stuffBD[0]) {
    
  if (stuffBD[0].hasOwnProperty(key)) {
    // console.log(key);
    labelBD.push(key);
    // console.log(stuff[0][key]);
    valueBD.push(stuffBD[0][key]);
  }
  i=i+1;
}


//combined 1
dps=[]
  for (var i = 0; i < value.length; i++){

    dps.push({
      y: Math.round(value[i]),
      label: String(label[i])
    });
  };
    console.log(dps); 


    //combined 2
dpsBD=[]
  for (var i = 0; i < value.length; i++){

    dpsBD.push({
      y: Math.round(valueBD[i]),
      label: String(labelBD[i])
    });
  };
    console.log(dpsBD);  



    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "theme2",
            animationEnabled: true,
            title: {
                text: "Kecerdasan Bisnis"
            },
            data: [
            {
                type: "column",                
                dataPoints:dps
            }
            ]
        });
        var chart2 = new CanvasJS.Chart("chartContainer2", {
            theme: "theme2",
            animationEnabled: true,
            title: {
                text: "Basis Data"
            },
            data: [
            {
                type: "column",                
                dataPoints: dpsBD
            }
            ]
        });

  chart.render();
  chart2.render();
 

        
    });
</script>

<?php include 'footer.php'; ?>