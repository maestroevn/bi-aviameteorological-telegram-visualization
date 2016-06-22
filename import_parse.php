<?php

die ('imported');

$host = "localhost";
$username = "root";
$password = "toxindzners";
$name = "meteo";

try {
    $connection = new PDO("mysql:host=$host;dbname=$name", $username, $password);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    for($year = 2010; $year<=2016; $year++) {
        $files = [];
        if ($handle = opendir('archive/AMIS_Archiv_' . $year . '/bii_cld_tph_wnd/')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && strstr($entry, "bii")) {

                    $files[] = $entry;
                }
            }
            closedir($handle);
        }
        asort($files);

        foreach ($files as $file) {
            $handle = fopen("archive/AMIS_Archiv_" . $year . "/bii_cld_tph_wnd/" . $file, "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {

                    $records = explode(" ", $line);

                    $date = $records[0];
                    $dateArray = explode('.', $date);
                    $day = $dateArray[0];
                    $month = $dateArray[1];
                    $rowYear = '20' . $dateArray[2];

                    if ($rowYear != $year) {
                        continue;
                    }

                    $dateFormatted = date('Y-m-d h:i:s', strtotime($rowYear . '-' . $month . '-' . $day . ' ' . $records[1]));

                    $officialTime = $records[3];
                    $officialHour = substr($officialTime, 0, 2);
                    $officialMinute = substr($officialTime, 2, 2);

                    $windDirection = 'NULL';
                    $windSpeed = 'NULL';
                    if (isset($records[4]) && is_numeric($records[4])) {
                        $wind = $records[4];
                        $windDirection = substr($wind, 0, 2);
                        $windDirection = intval($windDirection) * 10;
                        $windSpeed = substr($wind, 2, 2);
                        $windSpeed = intval($windSpeed);
                    } else {
                        echo $dateFormatted;
                    }

                    $totalCloudCount = 'NULL';
                    $relativeHumidity = 'NULL';
                    if (isset($records[6]) && is_numeric($records[6])) {
                        $cloudCountAndHumidity = $records[6];
                        $totalCloudCount = substr($cloudCountAndHumidity, 0, 1);
                        $totalCloudCount = intval($totalCloudCount);
                        $relativeHumidity = substr($cloudCountAndHumidity, 1, 3);
                        $relativeHumidity = intval($relativeHumidity);
                    } else {
                        echo $dateFormatted;
                    }

                    $temperature = 'NULL';
                    $lowLevelCloudCount = 'NULL';
                    if (isset($records[7]) && is_numeric($records[7])) {
                        $temperatureAndLowLevelCloudCount = $records[7];
                        $temperature = substr($temperatureAndLowLevelCloudCount, 0, 3);
                        $temperature = intval($temperature);
                        $lowLevelCloudCount = substr($temperatureAndLowLevelCloudCount, 3, 1);
                        $lowLevelCloudCount = intval($lowLevelCloudCount);
                    } else {
                        echo $dateFormatted;
                    }

                    $maxWindSpeed = 'NULL';
                    if (isset($records[8]) && is_numeric($records[8])) {
                        $maxWindSpeedAndThunderstorm = $records[8];
                        $maxWindSpeed = substr($maxWindSpeedAndThunderstorm, 0, 2);
                        $maxWindSpeed = intval($maxWindSpeed);
                    } else {
                        echo $dateFormatted;
                    }

                    $meteorNumber = 'NULL';
                    if (isset($records[9]) && is_numeric($records[9])) {
                        $meteorNumberGroup = $records[9];
                        $meteorNumber = substr($meteorNumberGroup, 0, 1);
                        $meteorNumber = intval($meteorNumber);
                    } else {
                        echo $dateFormatted;
                    }

                    $cloudHeight = 'NULL';
                    if (isset($records[10]) && is_numeric($records[10])) {
                        $cloudHeight = $records[10];
                        $cloudHeight = intval($cloudHeight) * 10;
                    } else {
                        echo $dateFormatted;
                    }

                    $visibility = 'NULL';
                    if (isset($records[15]) && is_numeric($records[15])) {
                        $visibility = $records[15];
                        $visibility = intval($visibility) * 10;
                    } else {
                        echo $dateFormatted;
                    }

                    $sql = "
                        INSERT INTO data_parsed(
                            date_time,
                            official_hour,
                            official_minute,
                            wind_direction,
                            wind_speed,
                            total_cloud_count,
                            relative_humidity,
                            temperature,
                            low_level_cloud_count,
                            max_wind_speed,
                            meteor_number,
                            cloud_height,
                            visibility
                            )
                        VALUES (
                            '" . $dateFormatted . "',
                            '" . $officialHour . "',
                            '" . $officialMinute . "',
                            " . $windDirection . ",
                            " . $windSpeed . ",
                            " . $totalCloudCount . ",
                            " . $relativeHumidity . ",
                            " . $temperature . ",
                            " . $lowLevelCloudCount . ",
                            " . $maxWindSpeed . ",
                            " . $meteorNumber . ",
                            " . $cloudHeight . ",
                            " . $visibility . "
                        )
                    ";
//                    var_dump($sql);
//                    die;


//                    $sql = "
//                INSERT INTO data(
//                    col_1,
//                    col_2,
//                    col_3,
//                    col_4,
//                    col_5,
//                    col_6,
//                    col_7,
//                    col_8,
//                    col_9,
//                    col_10,
//                    col_11,
//                    col_12,
//                    col_13,
//                    col_14,
//                    col_15,
//                    col_16,
//                    col_17,
//                    col_18,
//                    col_19,
//                    col_20
//                    )
//                VALUES (
//                    '" . (isset($records[0]) ? $records[0] : '') . "',
//                    '" . (isset($records[1]) ? $records[1] : '') . "',
//                    '" . (isset($records[2]) ? $records[2] : '') . "',
//                    '" . (isset($records[3]) ? $records[3] : '') . "',
//                    '" . (isset($records[4]) ? $records[4] : '') . "',
//                    '" . (isset($records[5]) ? $records[5] : '') . "',
//                    '" . (isset($records[6]) ? $records[6] : '') . "',
//                    '" . (isset($records[7]) ? $records[7] : '') . "',
//                    '" . (isset($records[8]) ? $records[8] : '') . "',
//                    '" . (isset($records[9]) ? $records[9] : '') . "',
//                    '" . (isset($records[10]) ? $records[10] : '') . "',
//                    '" . (isset($records[11]) ? $records[11] : '') . "',
//                    '" . (isset($records[12]) ? $records[12] : '') . "',
//                    '" . (isset($records[13]) ? $records[13] : '') . "',
//                    '" . (isset($records[14]) ? $records[14] : '') . "',
//                    '" . (isset($records[15]) ? $records[15] : '') . "',
//                    '" . (isset($records[16]) ? $records[16] : '') . "',
//                    '" . (isset($records[17]) ? $records[17] : '') . "',
//                    '" . (isset($records[18]) ? $records[18] : '') . "',
//                    '" . (isset($records[19]) ? $records[19] : '') . "'
//                )
//            ";

                    $connection->exec($sql);
                }

                fclose($handle);
            } else {
                // error opening the file.
            }
        }
    }
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;