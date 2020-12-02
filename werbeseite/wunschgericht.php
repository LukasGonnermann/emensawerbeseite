<?php

$gericht_name = $_POST['gericht_name'];
$gericht_beschreibung = $_POST['gericht_beschreibung'];
$ersteller_name = $_POST['ersteller_name'];
$ersteller_email = $_POST['ersteller_email'];

$link = mysqli_connect(
    "127.0.0.1",
    "root",
    "praktPass",
    "emensawerbeseite",
    3306
);

if (!$link) {
    echo "Datenbank Verbindung Fehlgeschlagen: " . mysqli_connect_error();
}

$dt = date("YYYY-MM-DD HH:MM:SS",time());

$gericht_query = "INSERT INTO wunschgericht (name,beschreibung,erstellt_am)
            VALUES($gericht_name, $gericht_beschreibung, $dt)";
$ersteller_query = "INSERT INTO ersteller (name,email)
                    VALUES ($ersteller_name, $ersteller_email)";

$query_status = mysqli_query($link,$gericht_query);
if (!$query_status){
    echo "Fehler";
}
$query_status = mysqli_query($link, $ersteller_query);
if (!$query_status){
    echo "Fehler";
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Wunschgericht</title>
    <style>
        div {
            display: flex;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<form method="post">
    <fieldset>
        <legend>Wunschgericht vorschlagen</legend>
        <div>
            <label for="gericht_name_TF">Gericht Name:</label>
            <input id="gericht_name_TF" type="text" name="gericht_name" placeholder="Spaghetti">
        </div>
        <div>
            <label for="gericht_beschreibung_TF">Beschreibung des Gerichts:</label>
            <input id="gericht_beschreibung_TF" type="text" name="gericht_beschreibung" placeholder="...">
        </div>
        <div>
            <label for="ersteller_name">Ersteller/-in:</label>
            <input id="ersteller_name" type="text" name="ersteller_name">
        </div>
        <div>
            <label for="ersteller_email">Ersteller/-in Email Adresse:</label>
            <input id="ersteller_email" type="email" name="ersteller_email">
        </div>
        <div>
            <button type="submit" name="action" value="submit">Wunschgericht abschicken!</button>
        </div>
    </fieldset>
</form>
</body>
</html>