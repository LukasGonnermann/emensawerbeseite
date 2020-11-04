<?php
/**
 * Praktikum DBWT. Autoren:
 * Lukas, Gonnermann, 3218299
 * Hamdy, Sarhan, 3251443
 */
$browser = $_SERVER['HTTP_USER_AGENT'];
$client = $_SERVER['REMOTE_ADDR'];
$date = date("d-m-Y h:i:s");
$file = fopen('accesslog.txt', 'a');
fwrite($file,"$date: $client, $browser \n");
fclose($file);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Accesslog</title>
</head>
<body>
<?php
    echo "$date <br> $browser <br> $client";
?>
</body>
</html>
