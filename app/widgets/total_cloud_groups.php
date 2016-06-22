<?php

$totalCloudCounts = [];

$sql = 'SELECT total_cloud_count, COUNT(*) as count FROM data_parsed WHERE MONTH(date_time) = ' . $selectedMonth . ' AND YEAR(date_time) = ' . $selectedYear . ' GROUP BY total_cloud_count';
foreach ($conn->query($sql) as $row) {
    $totalCloudCounts[$row['total_cloud_count']] = $row['count'];
}

?>

<script type="text/javascript">
    google.charts.setOnLoadCallback(drawTotalCloudGroupsPieChart);
    function drawTotalCloudGroupsPieChart() {
        var data = google.visualization.arrayToDataTable([
            ['Ամպերի ընդհանուր քանակ', 'Քանակ'],
            <?php
                foreach ($totalCloudCounts as $cloudCount => $count) {
                    echo "['" . $cloudCount . "', " . $count . "],";
                }
            ?>
        ]);

        var options = {
            title: 'Ամպերի ընդհանուր քանակ'
        };

        var chart = new google.visualization.PieChart(document.getElementById('total_clouds_group'));

        chart.draw(data, options);
    }
</script>
