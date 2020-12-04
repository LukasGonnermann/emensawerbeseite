<?php
$link = mysqli_connect(
    "127.0.0.1",
    "root",
    "1234",
    "emensawerbeseite",
    3306
);

if(isset($_POST["submit"])) {
    // Eingabenmaskierung
    $gericht_name = htmlspecialchars($_POST['gericht_name'])  ?? null;
    $gericht_name = mysqli_real_escape_string($link,$gericht_name);
    $gericht_beschreibung = htmlspecialchars($_POST['gericht_beschreibung'])?? null;
    $gericht_beschreibung = mysqli_real_escape_string($link,$gericht_beschreibung);
    $ersteller_name = htmlspecialchars($_POST['ersteller_name'])?? null;
    $ersteller_name = mysqli_real_escape_string($link,$ersteller_name);
    $ersteller_email = htmlspecialchars($_POST['ersteller_email']) ?? null;
    $ersteller_email = mysqli_real_escape_string($link,$ersteller_email);

    // Prepared Statement fuer Wunschgericht
    $wg_stmt = mysqli_stmt_init($link);
    mysqli_stmt_prepare($wg_stmt,
        "INSERT INTO emensawerbeseite.wunschgericht (name, beschreibung,erstellt_am)
                    VALUES (gericht_name, gericht_beschreibung, now())");
    mysqli_stmt_bind_param($wg_stmt, 's',$gericht_name,$gericht_beschreibung);
    mysqli_stmt_execute($wg_stmt);

    // Prepared Statement fuer ersteller
    $e_stmt = mysqli_stmt_init($link);
    mysqli_stmt_prepare($e_stmt,
        "INSERT INTO emensawerbeseite.ersteller (name, email)
                    VALUES (ersteller_name, ersteller_email)");
    mysqli_stmt_bind_param($e_stmt, 's',$ersteller_name,$ersteller_email);
    mysqli_stmt_execute($e_stmt);

    // Nutzer hat keinen Zugriff auf diese Werte
    $wunschgericht_hat_id_wid="INSERT INTO emensawerbeseite.wunschgericht_hat_ersteller (wid, eid)
                  SELECT wid , eid FROM emensawerbeseite.wunschgericht, emensawerbeseite.ersteller ORDER BY wid DESC , eid DESC LIMIT 1 ";
    mysqli_query($link, $wunschgericht_hat_id_wid);
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
            <button type="submit" name="submit" value="submit">Wunschgericht abschicken!</button>
        </div>
    </fieldset>
</form>
</body>
</html>