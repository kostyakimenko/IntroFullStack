<?php
$config = include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
                  . 'config' . DIRECTORY_SEPARATOR . 'config.php';

if (file_exists($config['json'])) {
    $dataTable = file_get_contents($config['json']);
}
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
            let dataTable = <?php echo $dataTable ?? 0; ?>;
            let formatTable = [];

            if (dataTable) {
                for (let key in dataTable) {
                    let entry = [key, dataTable[key]];
                    formatTable.push(entry);
                }
            }

            return formatTable;
        }
    </script>
    <title>Chart</title>
</head>
<body>
    <div class="chart" id="piechart"></div>
    <button class="back-btn" onclick="location.href='/index.php'">Back to home</button>
</body>
</html>