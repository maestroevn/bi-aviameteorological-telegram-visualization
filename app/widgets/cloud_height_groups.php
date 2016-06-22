<?php

$firstGroup = 0;
$secondGroup = 0;
$thirdGroup = 0;

$sql = 'SELECT COUNT(*) as count FROM data_parsed WHERE cloud_height > 0 AND cloud_height <= 50 AND MONTH(date_time) = ' . $selectedMonth . ' AND YEAR(date_time) = ' . $selectedYear;
foreach ($conn->query($sql) as $row) {
    $firstGroup = $row['count'];
}

$sql = 'SELECT COUNT(*) as count FROM data_parsed WHERE cloud_height > 50 AND cloud_height <= 800 AND MONTH(date_time) = ' . $selectedMonth . ' AND YEAR(date_time) = ' . $selectedYear;
foreach ($conn->query($sql) as $row) {
    $secondGroup = $row['count'];
}

$sql = 'SELECT COUNT(*) as count FROM data_parsed WHERE cloud_height > 800 AND cloud_height < 2000 AND MONTH(date_time) = ' . $selectedMonth . ' AND YEAR(date_time) = ' . $selectedYear;
foreach ($conn->query($sql) as $row) {
    $thirdGroup = $row['count'];
}

?>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawCloudHeightGroupsPieChart);
    function drawCloudHeightGroupsPieChart() {

        var data = google.visualization.arrayToDataTable([
            ['Ամպի Բարձրություն', 'Քանակ'],
            ['0-50մ', <?= $firstGroup ?>],
            ['50-800մ', <?= $secondGroup ?>],
            ['800-2000մ', <?= $thirdGroup ?>]
        ]);

        var options = {
            title: 'Դիտարկված ամպերի քանակ՝ ըստ բարձրության'
        };

        var chart = new google.visualization.PieChart(document.getElementById('cloud_height_groups'));

        chart.draw(data, options);
    }
</script>
