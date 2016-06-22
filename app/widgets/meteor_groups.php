<?php

$meteors = [];

$sql = 'SELECT meteor_number, COUNT(*) as count FROM data_parsed WHERE MONTH(date_time) = ' . $selectedMonth . ' AND YEAR(date_time) = ' . $selectedYear . ' GROUP BY meteor_number';
foreach ($conn->query($sql) as $row) {
    $meteors[$row['meteor_number']] = $row['count'];
}

?>

<script type="text/javascript">
    google.charts.setOnLoadCallback(drawMeteorGroupsPieChart);
    function drawMeteorGroupsPieChart() {
        var data = google.visualization.arrayToDataTable([
            ['Երևույթ', 'Քանակ'],
            <?php
                foreach ($meteors as $meteorNumber => $count) {
                    echo "['Երևույթ - " . $meteorNumber . "', " . $count . "],";
                }
            ?>
        ]);

        var options = {
            title: 'Դիտարկված Երևույթներ'
        };

        var chart = new google.visualization.PieChart(document.getElementById('meteor_groups'));

        chart.draw(data, options);
    }
</script>
