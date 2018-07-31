<?php
session_start();
$table = $_SESSION['table'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/chart.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Activity');
            data.addColumn('number', 'Votes');
            data.addRows(addTable());

            const options = {
                title: 'Activity rating',
                legend: 'left',
                fontSize: 18,
            };

            const chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }

        function addTable() {
            let jsonTable = <?php echo json_encode($table); ?>;
            let formatTable = [];

            for (let key in jsonTable) {
                let entry = [key, jsonTable[key]];
                formatTable.push(entry);
            }

            return formatTable;
        }
    </script>
    <title>Chart</title>
</head>
<body>
    <div class="chart" id="piechart"></div>
</body>
</html>