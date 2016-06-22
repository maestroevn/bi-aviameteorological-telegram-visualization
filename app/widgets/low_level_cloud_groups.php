<?php

$lowLevelCloudCounts = [];

$sql = 'SELECT low_level_cloud_count, COUNT(*) as count FROM data_parsed WHERE MONTH(date_time) = ' . $selectedMonth . ' AND YEAR(date_time) = ' . $selectedYear . ' GROUP BY low_level_cloud_count';
foreach ($conn->query($sql) as $row) {
    $lowLevelCloudCounts[$row['low_level_cloud_count']] = $row['count'];
}

?>

<script type="text/javascript">
    google.charts.setOnLoadCallback(drawLowLevelCloudGroupsPieChart);
    function drawLowLevelCloudGroupsPieChart() {
        var data = google.visualization.arrayToDataTable([
            ['Ցածր ամպերի քանակ', 'Քանակ'],
            <?php
                foreach ($lowLevelCloudCounts as $cloudCount => $count) {
                    echo "['" . $cloudCount . "', " . $count . "],";
                }
            ?>
        ]);

        var options = {
            title: 'Ցածր ամպերի քանակ'
        };

        var chart = new google.visualization.PieChart(document.getElementById('low_level_clouds_group'));

        chart.draw(data, options);
    }
</script>
