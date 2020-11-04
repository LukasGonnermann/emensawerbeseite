<?php
/**
 * Praktikum DBWT. Autoren:
 * Lukas, Gonnermann, 3218299
 * Hamdy, Sarhan, 3251443
 */
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019],
];

function fehlendeWinnerJahre($famousMeals)
{
    $years = [];
    foreach ($famousMeals as $key1 => $val1) {
        foreach ($val1 as $type => $val) {
            if ($type == 'winner') {
                foreach ($val as $year) {
                    array_push($years, $year);
                }
                if (!is_array($val)) {
                    array_push($years, $val);
                }
            }
        }
    }
    sort($years);
    $missingYears = [];
    for ($i = 2000; $i < 2021; $i++) {
        if (!array_search($i, $years)) {
            array_push($missingYears, $i);
        }
    }
    return ($missingYears);
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Array</title>
    <style type="text/css">
        li {
            margin-top: 1%;
            margin-bottom: 1%;
        }
    </style>
</head>
<body>

<ol>
    <?php
    foreach ($famousMeals as $key1 => $val1) {
        echo "<li>";
        foreach ($val1 as $type => $val) {
            if ($type == 'name') {
                echo "$val <br>";
            }
            if ($type == 'winner') {
                $i = 0;
                $len = count($val);
                foreach (array_reverse($val) as $year) {
                    echo "$year";
                    $i++;
                    if ($i != $len) echo ", ";
                }
                if (!is_array($val)) {
                    echo "$val";
                }
            }
        }
        echo "</li>";
    }
    ?>
</ol>

<h2>Fehlende Jahre:</h2>
<?php $i = 0;
$mY = fehlendeWinnerJahre($famousMeals);
$len = count($mY);
foreach ($mY as $missYear) {
    echo $missYear;
    $i++;
    if ($i != $len) echo ", ";
}
?>

</body>
</html>