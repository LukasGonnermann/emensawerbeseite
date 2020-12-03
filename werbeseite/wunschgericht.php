<?php

$gericht_name = $_POST['gericht_name'];
$gericht_beschreibung = $_POST['gericht_beschreibung'];
$ersteller_name = $_POST['ersteller_name'];
$ersteller_email = $_POST['ersteller_email'];

$link = mysqli_connect(
    "127.0.0.1",
    "root",
    "1234",
    "emensawerbeseite",
    3306
);

if (!$link) {
    echo "Datenbank Verbindung Fehlgeschlagen: " . mysqli_connect_error();
}
//else echo "Verbindung erfolgreich!";
if(!isset($_POST["submit"])) {
  echo "ERROR";
}
else {
    $ersteller_query = "INSERT INTO emensawerbeseite.ersteller (name, email)
                    VALUES ($ersteller_name, $ersteller_email)";
    $ersteller_query = "INSERT INTO emensawerbeseite.wunschgericht (name, beschreibung,erstellt_am)
                    VALUES ($gericht_name, $gericht_beschreibung, now())";

    //$res = mysqli_query($link, $ersteller_query);
    //var_dump($res);
}



/* SQL DEFINITIONEN
wunschgericht (
    wid INTEGER PRIMARY KEY AUTO_INCREMENT,
    name varchar(40) not null,
    beschreibung varchar(400) not null,
    erstellt_am datetime not null
);

ersteller (
    eid INTEGER PRIMARY KEY AUTO_INCREMENT,
    name varchar(40) not null default 'anonym',
    email varchar(40) not null
);

wunschgericht_hat_ersteller (
    wid INTEGER REFERENCES wunschgericht(wid),
    eid INTEGER REFERENCES ersteller(eid)
);
 */


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
            <button type="submit" name="submit" value="submit">Wunschgericht abschicken!</button>
        </div>
    </fieldset>
</form>
</body>
</html>