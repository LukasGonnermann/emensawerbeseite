<?php
$link = mysqli_connect(
    "127.0.0.1",
    "root",
    "1234",
    "emensawerbeseite",
    3306
);

if (isset($_POST["submit"])) {
    // Eingabenmaskierung
    $gericht_name = htmlspecialchars($_POST['gericht_name']) ?? null;
    $gericht_name = mysqli_real_escape_string($link, $gericht_name);
    $gericht_beschreibung = htmlspecialchars($_POST['gericht_beschreibung']) ?? null;
    $gericht_beschreibung = mysqli_real_escape_string($link, $gericht_beschreibung);
    $ersteller_name = htmlspecialchars($_POST['ersteller_name']) ?? null;
    $ersteller_name = mysqli_real_escape_string($link, $ersteller_name);
    $ersteller_email = htmlspecialchars($_POST['ersteller_email']) ?? null;
    $ersteller_email = mysqli_real_escape_string($link, $ersteller_email);

    /*    Prepared Statements:    */
    // Wunschgericht Prepared Statement
    // Prepare wunschgericht Statement...
    if (!$wg_stmt = $link->prepare("INSERT INTO emensawerbeseite.wunschgericht (name, beschreibung) VALUES (?,?)")) {
        echo "Prepare failed: (" . $wg_stmt->errno . ") " . $wg_stmt->error;
    }
    // Bind wunschgericht Statement...
    if (!$wg_stmt->bind_param('ss', $gericht_name, $gericht_beschreibung)) {
        echo "Binding parameters failed: (" . $wg_stmt->errno . ") " . $wg_stmt->error;
    }
    // Execute Statement
    if (!$wg_stmt->execute()) {
        echo "Execute failed: (" . $wg_stmt->errno . ") " . $wg_stmt->error;
    }

    // Ersteller Prepared Statement
    // siehe oben fuer Kommentare
    if (!$e_stmt = $link->prepare("INSERT INTO emensawerbeseite.ersteller (name, email) VALUES (?, ?)")) {
        echo "Prepare failed: (" . $e_stmt->errno . ") " . $e_stmt->error;
    }
    if (!$e_stmt->bind_param('ss', $ersteller_name, $ersteller_email)) {
        echo "Binding parameters failed: (" . $e_stmt->errno . ") " . $e_stmt->error;
    }
    if (!$e_stmt->execute()) {
        echo "Execute failed: (" . $e_stmt->errno . ") " . $e_stmt->error;
    }

    // Nutzer hat keinen Zugriff auf diese Werte
    $wunschgericht_hat_id_wid = "INSERT INTO emensawerbeseite.wunschgericht_hat_ersteller (wid, eid)
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
            <input id="gericht_name_TF" type="text" name="gericht_name" placeholder="Spaghetti" value="<?=htmlspecialchars($gericht_name);?>" required>
        </div>
        <div>
            <label for="gericht_beschreibung_TF">Beschreibung des Gerichts:</label>
            <input id="gericht_beschreibung_TF" type="text" name="gericht_beschreibung" placeholder="..." value="<?=htmlspecialchars($gericht_beschreibung);?>" required>
        </div>
        <div>
            <label for="ersteller_name">Ersteller/-in:</label>
            <input id="ersteller_name" type="text" name="ersteller_name" value="<?=htmlspecialchars($ersteller_name);?>" required>
        </div>
        <div>
            <label for="ersteller_email">Ersteller/-in Email Adresse:</label>
            <input id="ersteller_email" type="email" name="ersteller_email" value="<?=htmlspecialchars($ersteller_email);?>" required>
        </div>
        <div>
            <button type="submit" name="submit" value="submit">Wunschgericht abschicken!</button>
        </div>
    </fieldset>
</form>
</body>
</html>