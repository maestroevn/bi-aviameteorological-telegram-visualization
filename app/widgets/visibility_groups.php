<?php

$firstGroup = 0;
$secondGroup = 0;
$thirdGroup = 0;

$sql = 'SELECT COUNT(*) as count FROM data_parsed WHERE visibility > 0 AND visibility <= 50 AND MONTH(date_time) = ' . $selectedMonth . ' AND YEAR(date_time) = ' . $selectedYear;
foreach ($conn->query($sql) as $row) {
    $firstGroup = $row['count'];
}

$sql = 'SELECT COUNT(*) as count FROM data_parsed WHERE visibility > 50 AND visibility <= 1000 AND MONTH(date_time) = ' . $selectedMonth . ' AND YEAR(date_time) = ' . $selectedYear;
foreach ($conn->query($sql) as $row) {
    $secondGroup = $row['count'];
}

$sql = 'SELECT COUNT(*) as count FROM data_parsed WHERE visibility > 1000 AND visibility < 2000 AND MONTH(date_time) = ' . $selectedMonth . ' AND YEAR(date_time) = ' . $selectedYear;
foreach ($conn->query($sql) as $row) {
    $thirdGroup = $row['count'];
}

?>

<script type="text/javascript">
    google.charts.setOnLoadCallback(drawVisibilityGroupsPieChart);
    function drawVisibilityGroupsPieChart() {
        var data = google.visualization.arrayToDataTable([
            ['Տեսանելիություն', 'Քանակ'],
            ['0-50մ', <?= $firstGroup ?>],
            ['50-1000մ', <?= $secondGroup ?>],
            ['1000-2000մ', <?= $thirdGroup ?>]
        ]);

        var options = {
            title: 'Դիտարկված տեսանելիություն՝ ըստ խմբերի'
        };

        var chart = new google.visualization.PieChart(document.getElementById('visibility_groups'));

        chart.draw(data, options);
    }
</script>
