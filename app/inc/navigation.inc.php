<?php

$years = [
    2010,
    2011,
    2012,
    2013,
    2014,
    2015
];

$months = [
    '01' => 'Հունվար',
    '02' => 'Փետրվար',
    '03' => 'Մարտ',
    '04' => 'Ապրիլ',
    '05' => 'Մայիս',
    '06' => 'Հունիս',
    '07' => 'Հուլիս',
    '08' => 'Օգոստոս',
    '09' => 'Սեպտեմբեր',
    '10' => 'Հոկտեմբեր',
    '11' => 'Նոյեմբեր',
    '12' => 'Դեկտեմբեր'
];

?>
<br>
<div class="row">
    <?php
        foreach ($years as $year) {
            ?>
            <div class="col-sm-2">
                <a class="btn btn-block btn-lg <?= $selectedYear == $year ? 'btn-success' : 'btn-default' ?>" href="<?= BASE_URL . '?year=' . $year ?>"><?= $year ?></a>
            </div>
            <?php
        }
    ?>
</div>
<br>
<div class="row">
    <?php
    foreach ($months as $monthIndex => $month) {
        ?>
        <div class="col-sm-1">
            <a class="btn btn-block <?= $selectedMonth == $monthIndex ? 'btn-success' : 'btn-default' ?>" href="<?= BASE_URL . '?year=' . $selectedYear . '&month=' . $monthIndex ?>"><?= $month ?></a>
        </div>
        <?php
    }
    ?>
</div>