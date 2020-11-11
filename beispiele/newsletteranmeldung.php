<?php
$errorp = '';
$geschlechtp = '';
$vornamep = '';
$nachnamep = '';
$emailp = '';
$intervalp = '';
$checkboxp = '';

if(!isset($_POST["submit"])) {
    $error = 'Error';
}

else {
    if (!empty($_POST['geschlecht'])) {
        $geschlechtp = $_POST['geschlecht'];

    } else {
        $errorp = 'Bitte Ihre Geschlecht auswählen!';

    }
    if (!empty($_POST['vorname'])&&!ctype_space($_POST['vorname'])) {
        $vornamep = $_POST['vorname'];
        if (!preg_match("/^[a-zA-Z ]*$/", $vornamep)) {
            $errorp = 'Nur Buchstaben und Leerzeichen erlaubt! ';
        }


    } else {
        $errorp = 'Bitte Ihre Vorname eingeben!';

    }
    if (!empty($_POST['nachname'])&&!ctype_space($_POST['nachname'])) {
        $nachnamep = $_POST['nachname'];
        if (!preg_match("/^[a-zA-Z ]*$/", $nachnamep)) {
            $errorp = 'Nur Buchstaben und Leerzeichen erlaubt!';
        }
    } else {
        $errorp = 'Bitte Ihre Vorname eingeben!';

    }
    if (empty($_POST["email"])) {
        $errorp = 'Bitte Ihre Email eingaben!';
    } else {
        $emailp = $_POST['email'];
        if (!filter_var($emailp, FILTER_VALIDATE_EMAIL)) {
            $errorp = 'Ihre E-Mail entspricht nicht den Vorgaben!';
        }
    }
    if (empty($_POST["interval"])) {
        $errorp = 'Bitte Interval auswählen!';
    } else {
        $intervalp = $_POST['interval'];

    }
    if ($_POST['checkbox'] == 'On') {
        $errorp = 'Bitte Datenschutz lesen!';
    } else {
        $checkboxp = $_POST['checkbox'];

    }
    if ($errorp == '') {
        $file_open = fopen("data.csv", "a");
        $no_rows = count(file("data.csv"));
        if($no_rows > 1){
            $no_rows = ($no_rows - 1) + 1 ;
        }
        $form_data = array(
            's_n' => $no_rows,
            'gesch' => $geschlechtp,
            'vorn' => $vornamep,
            'nachn' => $nachnamep,
            'em' => $emailp,
            'inter' => $intervalp,
            'ch' => $checkboxp
        );
        fputcsv($file_open, $form_data);
        echo '<span style="color:green";>Daten erfolgreich gespeichert!</span>';

    }


}

?>
<!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Lukas, Gonnermann, 3218299
- Hamdy, Sarhan, 3251443
-->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Newsletter</title>
</head>
<body>
<form method="post">
    <fieldset>
        <b style="color: red"><?php echo $errorp ?></b>
        <legend>Anmeldung</legend><br>
        <label for="frau">Anrede</label><br>
        <input id="frau" type="radio" name="geschlecht" value="Frau">
        <label for="frau">Frau</label> <br>
        <input id="herr" type="radio" name="geschlecht" value="Herr">
        <label for="herr">Herr</label>
        <br>
        <br>
        <label for="vorname">Vorname*</label><br>
        <input id="vorname" type="text" name="vorname" placeholder="Bitte geben Sie Ihren Vornamen ein" size="30" required><br>
        <br>
        <label for="nachname">Nachname*</label><br>
        <input id="nachname" type="text" name="nachname" placeholder="Bitte geben Sie Ihren Nachnamen ein" size="30" required><br>
        <br>
        <label for="email">Email*</label><br>
        <input id="email" type="email" name="email" placeholder="Bitte geben Sie Ihre E-Mail ein" size="30" required><br>
        <br>
        <label for="interval">Benachrichtigungsintervall</label><br>
        <select id="interval" name="interval">
            <option value="tag">Tag</option>
            <option value="woche">Woche</option>
            <option value="monat">Monat</option>
        </select><br>
        <br>
        <input id="checkbox" type="checkbox" name="checkbox">
        <label for="checkbox">Datenschutzhinweise gelesen</label><br>
        <br>
        <input id="submit" name="submit" type="submit" value="Abschicken">
        <br>
        <p><sup>*)</sup> Eingaben sind Pflicht</p>
    </fieldset>
</form>
</body>
</html>

