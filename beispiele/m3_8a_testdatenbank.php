<?php
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
