<?php

require_once "inc/main.inc.php";
require_once "inc/database.inc.php";

$selectedYear = '2015';
$selectedMonth = '01';
if (isset($_GET['year'])) {
    $selectedYear = $_GET['year'];
}

if (isset($_GET['month'])) {
    $selectedMonth = $_GET['month'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php
        require_once "widgets/cloud_height_groups.php";
        require_once "widgets/visibility_groups.php";
        require_once "widgets/meteor_groups.php";
        require_once "widgets/total_cloud_groups.php";
        require_once "widgets/low_level_cloud_groups.php";
    ?>
</head>
<body>

<div class="container-fluid">
    <?php
        require_once "inc/navigation.inc.php";
    ?>

    <div class="row">
        <div class="col-sm-4" id="cloud_height_groups" style="height: 500px;"></div>
        <div class="col-sm-4" id="visibility_groups" style="height: 500px;"></div>
        <div class="col-sm-4" id="meteor_groups" style="height: 500px;"></div>
    </div>

    <div class="row">
        <div class="col-sm-4" id="total_clouds_group" style="height: 500px;"></div>
        <div class="col-sm-4" id="low_level_clouds_group" style="height: 500px;"></div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>