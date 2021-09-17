<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>
<h1>Line Chart</h1>


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

$query = "select Age, Decision_Making from tabe";
$data = mysqli_query($conn, $query);
$dataPoints = array();
while ($row = $data -> fetch_array(MYSQLI_NUM)) {
    array_push($dataPoints, array("x"=> $row[0], "y"=> $row[1]));
}
print json_encode($dataPoints);

// $dataPoints = array();
//Best practice is to create a separate file for handling connection to database
// try{
//      // Creating a new connection.
//     // Replace your-hostname, your-db, your-username, your-password according to your database
//     $link = new PDO('mysql:host=localhost;dbname=cobaevelyn', 'root', '');
  
//     $handle = $link->prepare('select * from tabel'); 
//     $handle->execute(); 
//     $result = $handle->fetchAll(PDO::FETCH_OBJ);
    
//     foreach($result as $row){

//         array_push($dataPoints, array("x"=> $row->Age, "y"=> $row->Decision_Making));
//     }
//   $link = null;
// }
// catch(PDOException $ex){
//     print($ex->getMessage());
// }

    // $dataPoints = array(
	// array("x" => 10, "y" => 71),
	// array("x" => 20, "y" => 55),
	// array("x" => 30, "y" => 50),
	// array("x" => 40, "y" => 65),
	// array("x" => 50, "y" => 95),
	// array("x" => 60, "y" => 68),
	// array("x" => 70, "y" => 28),
	// array("x" => 80, "y" => 34),
	// array("x" => 90, "y" => 14),
	// array("x" => 100, "y" => 33),
	// array("x" => 110, "y" => 42),
	// array("x" => 120, "y" => 62),
	// array("x" => 130, "y" => 70),
	// array("x" => 140, "y" => 85),
	// array("x" => 150, "y" => 58),
	// array("x" => 160, "y" => 34),
	// array("x" => 170, "y" => 24),
	// array("x" => 180, "y" => 33),
	// array("x" => 190, "y" => 28),
	// array("x" => 200, "y" => 42)
    // );

    // print json_encode($dataPoints);
    ?>
    <div id="chartContainer"></div>
<script type="text/javascript">

    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2",
            zoomEnabled: true,
            animationEnabled: true,
            title: {
                text: "Line Chart in PHP using CanvasJS"
            },
            subtitles: [
                {
                    text: "Try Zooming and Panning"
                }
            ],
            data: [
            {
                type: "line",

                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart.render();
    });
</script>

<?php include '../footer.php'; ?>