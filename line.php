<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php include 'content.php'; ?>
<h1>Line Chart</h1>
<div id="chartContainer"></div>

<?php
$conn = mysqli_connect('localhost', 'root', '');
$query = "select Age, Decision_Making from tabel";
$data = mysqli_query($conn, $query);

    $dataPoints = array();
    while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
        array_push($dataPoints, $row);
    }
print  (json_encode($dataPoints));
?>

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

<?php include 'footer.php'; ?>