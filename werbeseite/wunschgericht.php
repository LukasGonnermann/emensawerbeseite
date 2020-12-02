<?php
// TBD
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Wunschgericht</title>
    <style>
        div{
            display: flex;
            margin-top:10px;
            margin-bottom:10px;
        }
    </style>
</head>
<body>
<form method="post">
    <fieldset>
        <legend>Wunschgericht vorschlagen</legend>
        <div>
            <label for="gericht_name">Gericht Name:</label>
            <input id="gericht_name" type="text" name="gericht_name_TF" placeholder="Spaghetti">
        </div>
        <div>
            <label for="gericht_beschreibung">Beschreibung des Gerichts:</label>
            <input id="gericht_beschreibung" type="text" name="gericht_beschreibung_TF" placeholder="...">
        </div>
        <div>
            <label for="ersteller_name">Ersteller/-in:</label>
            <input id="ersteller_name" type="text" name="ersteller_name_TF">
        </div>
        <div>
            <label for="ersteller_email">Ersteller/-in Email Adresse:</label>
            <input id="ersteller_email" type="email" name="ersteller_email_EF">
        </div>
        <div>
            <button type="submit" name="action" value="submit">Wunschgericht abschicken!</button>
        </div>
    </fieldset>
    <?php
    // TBD
    ?>
</form>
</body>
</html>