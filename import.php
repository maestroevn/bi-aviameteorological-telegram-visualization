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

                    $sql = "
                INSERT INTO data(
                    col_1,
                    col_2,
                    col_3,
                    col_4,
                    col_5,
                    col_6,
                    col_7,
                    col_8,
                    col_9,
                    col_10,
                    col_11,
                    col_12,
                    col_13,
                    col_14,
                    col_15,
                    col_16,
                    col_17,
                    col_18,
                    col_19,
                    col_20
                    )
                VALUES (
                    '" . (isset($records[0]) ? $records[0] : '') . "',
                    '" . (isset($records[1]) ? $records[1] : '') . "',
                    '" . (isset($records[2]) ? $records[2] : '') . "',
                    '" . (isset($records[3]) ? $records[3] : '') . "',
                    '" . (isset($records[4]) ? $records[4] : '') . "',
                    '" . (isset($records[5]) ? $records[5] : '') . "',
                    '" . (isset($records[6]) ? $records[6] : '') . "',
                    '" . (isset($records[7]) ? $records[7] : '') . "',
                    '" . (isset($records[8]) ? $records[8] : '') . "',
                    '" . (isset($records[9]) ? $records[9] : '') . "',
                    '" . (isset($records[10]) ? $records[10] : '') . "',
                    '" . (isset($records[11]) ? $records[11] : '') . "',
                    '" . (isset($records[12]) ? $records[12] : '') . "',
                    '" . (isset($records[13]) ? $records[13] : '') . "',
                    '" . (isset($records[14]) ? $records[14] : '') . "',
                    '" . (isset($records[15]) ? $records[15] : '') . "',
                    '" . (isset($records[16]) ? $records[16] : '') . "',
                    '" . (isset($records[17]) ? $records[17] : '') . "',
                    '" . (isset($records[18]) ? $records[18] : '') . "',
                    '" . (isset($records[19]) ? $records[19] : '') . "'
                )
            ";

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