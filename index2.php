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

$query = "select AVG(tugas) as 'Kecerdasan Bisnis' from cerdasbisnis";
$data = mysqli_query($conn, $query);
$dataPoints = array();


while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
    array_push($dataPoints, $row);
}

$queryy = "select AVG(tugas) as 'Basis Data' from basisdata";
$dataa = mysqli_query($conn, $queryy);
// $dataPoints = array();


while ($row = mysqli_fetch_array($dataa, MYSQLI_ASSOC)) {
    array_push($dataPoints, $row);
}


print json_encode($dataPoints[1]);
?>




<script type="text/javascript">
   var stuff = <?php print json_encode($dataPoints); ?>;
   stuf = [];

   for (var i = 0; i <stuff.length; i++){

    stuf.push(    
      stuff[i]
      );
    };

    console.log('oke',stuf);

label=[];
value=[];
maxval=[];
maxlabel=[]
//deklare max = var ke 0
for (key in stuf[0]) {
if (stuf[0].hasOwnProperty(key)) {
maxval.push(stuf[0][key]);
maxlabel.push(key)
// max.push({
//       y: stuf[0][key],
//       label: key
//     });
}
}
i=0
var tugas='Tugas : ';
for (var i = 0; i <stuf.length; i++){
    for (key in stuf[i]) {
        // console.log(key);
      if (stuf[i].hasOwnProperty(key)) {
        // console.log(key);
        label.push(key);
        // console.log(stuf[0][key]);
        value.push(stuf[i][key]);
        //max value
        if(maxval[0]<stuf[i][key]){
          maxval[0] =stuf[i][key];
          maxlabel[0] = tugas+key;
        }
      }
      // i=i+1;
    }
  }
  console.log('max',maxval,maxlabel)
//combine 3
// label3=[];
// value3=[];

// i=0
// for (key in stuf[0]) {
    
//   if (stuff3[0].hasOwnProperty(key)) {
//     // console.log(key);
//     label3.push(key);
//     // console.log(stuff[0][key]);
//     value3.push(stuff3[0][key]);
//   }
//   i=i+1;
// }


dps=[]

  for (var i = 0; i < value.length; i++){

    dps.push({
      y: Math.round(value[i]),
      label: String(label[i])
    });
  };
    console.log(dps); 

//combined them (most)
dpsBD=[]

  for (var i = 0; i < maxval.length; i++){

    dpsBD.push({
      y: Math.round(maxval[i]),
      label: String(maxlabel[i])
    });
  };
    console.log(dpsBD);  



    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "theme2",
            animationEnabled: true,
            title: {
                text: "Tugas"
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
                text: "Ringkasan"
            },
            data: [
            {
                type: "column",                
                dataPoints: dpsBD
            }
            ]
        });

  chart.render();
  // chart2.render();
 

        
    });
</script>

<?php include 'footer.php'; ?>