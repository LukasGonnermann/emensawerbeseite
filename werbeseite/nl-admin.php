
<html>
<head>
    <meta charset="UTF-8">


    <title>nl-admin</title>
</head>
<body>
<form method="post">
    <legend>Gespeicherte Daten</legend><br>
    <br>
    <input id="submit1" name="submit1" type="submit" value="Sortierung nach Name">
    <br>
    <br>
    <input id="submit2" name="submit2" type="submit" value="Sortierung nach Email">
    <br>




</form>

</body>
</html>

<?php
function readCSV($file)
{
    $row      = 0;
    $csvArray = array();
    if( ( $handle = fopen($file, "r") ) !== FALSE ) {
        while( ( $data = fgetcsv($handle, 0, ",") ) !== FALSE ) {
            $num = count($data);
            for( $c = 0; $c < $num; $c++ ) {
                $csvArray[$row][] = $data[$c];
            }
            $row++;
        }
    }
    if( !empty( $csvArray ) ) {
        return array_splice($csvArray, 0); //cut off the first row (names of the fields)
    } else {
        return false;
    }
}

$csvData = readCSV('gespeichert.csv');
if(isset($_POST["submit1"])){

    sort($csvData);
    print_r($csvData);
}
elseif(isset($_POST["submit2"])){

    asort($csvData);
    print_r($csvData);
}

?>
