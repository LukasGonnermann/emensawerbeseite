<?php
 $link = mysqli_connect(
    "127.0.0.1",
    "root",
    "praktPass",
    "emensawerbeseite",
     3306
);
if (!$link) {
    echo "Verbindung Fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
else echo "Erfolgreich Verbunden";

$sql_query = "SELECT * FROM gericht";
$res = mysqli_query($link, $sql_query);
var_dump($res);
?>
<!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Lukas, Gonnermann, 3218299
- Hamdy, Sarhan, 3251443
-->
<html lang="de">
<head>
    <meta charset="UTF-8"> <!--Für Sonderzeichen wie "ü"-->
    <title>Werbeseite</title>
</head>
<body>
<ul>
    <?php
    while ($row = mysqli_fetch_assoc($res)) {
        echo '<li>';
            $row['name'];
        echo '</li>';
    }
    ?>
</ul>
</body>
</html>
$link=mysqli_connect(
    "127.0.0.1", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "1234",    // Passwort
    "emensawerbeseite", // Auswahl der Datenbanken (bzw. des Schemas)
    3306

// optional port der Datenbank
);

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
$sql = "SELECT * FROM gericht";

$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}

while ($row = mysqli_fetch_assoc($result)) {
    echo '<li>',$row['id'], ':', $row['name'], '</li>';
}

mysqli_free_result($result);
mysqli_close($link);
