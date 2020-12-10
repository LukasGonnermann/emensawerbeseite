<?php
/**
 * Praktikum DBWT. Autoren:
 * Lukas, Gonnermann, 3218299
 * Hamdy, Sarhan, 3251443
 */

/**
 * Nur noch für Gerichte Anzahl verwendet
 */
$gerichteFileError = null;
$gerichte = [];
if (($file = fopen('gerichte.CSV', 'r')) !== FALSE) {
    while (($data = fgetcsv($file, 1000, ';')) !== FALSE) {
        if ((count($data) == 4)) {
            array_push($gerichte, $data);
        }
    }
    fclose($file);
} else {
    $gerichteFileError = "Gerichte fileopen error";
}

/**
 * Zahlen Calc Sektion
 */
// Anzahl Besuche in besuche.txt
$file = fopen('besuche.txt', 'r');
$besucherCount = fgets($file, 1000);
fclose($file);
$besucherCount = abs(intval($besucherCount) + 1);
$file = fopen('besuche.txt', 'w');
fwrite($file, $besucherCount);
fclose($file);

// Newsletteranmeldungen
$file = fopen('newsletter.txt', 'r');
$newsletterCounter = fgets($file, 1024);
if ($newsletterCounter !== False) {
    $newsletterCounter = abs(intval($newsletterCounter));
}

/**
 * Newsletteranmeldung
 * Nach gültigen eingaben Filtern und bei erfolg Newslettercounter erhöhen
 */

$errorp = '';
$confirmed_msg = null;
$namep = '';
$emailp = '';
$sprachep = '';
$datenp = '';

// Fehlerhaft
if (!isset($_POST['submit'])) {
    $error = 'Error';
} else {
    if (!empty($_POST['name'])&&!ctype_space($_POST['name'])) {
        $namep = $_POST['name'];
        if (!preg_match("/^[a-zA-Z ]*$/", $namep)) {
            $errorp = 'Nur Buchstaben und Leerzeichen erlaubt! ';
        }

    } else {
        $errorp = 'Bitte Ihre Name eingeben!';
    }
    if (!empty($_POST['email'])&&!ctype_space($_POST['email'])) {
        $emailp = $_POST['email'];
        if (!filter_var($emailp, FILTER_VALIDATE_EMAIL)) $errorp = 'Ihre E-Mail entspricht nicht den Vorgaben!';
        else if (strpos($emailp, "rcpt.at")) $errorp = 'Ihre E-Mail enthält eine ungültige Domain!';
        else if (strpos($emailp, "damnthespam.at")) $errorp = 'Ihre E-Mail enthält eine ungültige Domain!';
        else if (strpos($emailp, "wegwerfmail.de")) $errorp = 'Ihre E-Mail enthält eine ungültige Domain!';
        else if (strpos($emailp, "trashmail.")) $errorp = 'Ihre E-Mail enthält eine ungültige Domain!';

    } else {
        $errorp = 'Bitte Ihre Email eingeben!';

    }
    if (!empty($_POST['sprache'])) {
        $sprachep = $_POST['sprache'];

    } else {
        $errorp = 'Bitte Ihre Sprache auswählen!';

    }
    if (!empty($_POST['checkbox'])) {
        $datenp = $_POST['checkbox'];

    } else {
        $errorp = 'Bitte Ihre Datenschutz lesen und beschtätigen!';

    }
    if ($errorp == '') {
        $newsletter_anmeldung_file = "gespeichert.csv";
        $fileopen = fopen($newsletter_anmeldung_file, "a");
        $no_rows = count(file($newsletter_anmeldung_file));

        $form_data = array(
            's_n' => $no_rows,
            'n' => $namep,
            'e' => $emailp,
            'sp' => $sprachep,
            'd' => $datenp,

        );
        fputcsv($fileopen, $form_data);
        $newsletterCounter++;
        $file = fopen('newsletter.txt', 'w');
        fwrite($file, $newsletterCounter);
        $confirmed_msg = "Daten erfolgreich gespeichert";
    }
}

/**
 * Datenbank connection
 * $link abh von der lokalen Datenbank setzten
 */

$link = mysqli_connect(
    "127.0.0.1",
    "root",
    "1234",
    "emensawerbeseite",
    3306
);

$dbError = null;
if (!$link) {
    $dbError = "Datenbank Verbindung Fehlgeschlagen: " . mysqli_connect_error();
}

/**
 * Datenbank anfragen
 */
// Gerichte Abfragen
$query = "SELECT name,preis_intern,preis_extern,id 
                          FROM gericht 
                          ORDER BY name ASC LIMIT 5;";
$gerichte_db_res = mysqli_query($link, $query);

function getAllergensById($id, $link)
{
    // DB Query
    $query = "SELECT code FROM gericht_hat_allergen WHERE gericht_id =$id";
    return mysqli_query($link, $query);
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <link href="ind_style.css" rel="stylesheet">
    <style type="text/css">
        table, th, td {
            border: 1px solid black;
        }

    </style>
</head>
<body>
<div id="main_grid_container">
    <!-- Header Section -->
    <div id="head">
        <div id="logo" class="header_innen_abstaende">
            <div>E-Mensa Logo</div>
        </div>
        <div id="adressen" class="header_innen_abstaende">
            <a href="#ankuendigungen">Ankündigungen</a>
            <a href="#speisen">Speisen</a>
            <a href="#zahlen">Zahlen</a>
            <a href="#diuw">Wichtig für uns</a>
            <a href="#kontakt">Kontakt</a>
        </div>
    </div>
    <hr>
    <!-- Content -->
    <div id="content">
        <!-- Placeholder div -->
        <div id="placeholder">
            Hier könnt ihre Werbung stehen
        </div>
        <!-- Ankündigungen -->
        <div>
            <h2 id="ankuendigungen">Bald gibt es Essen auch online</h2>
            <p id="info">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                ut labore
                et
                dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                Stet
                clita kasd gubergren,
                no sea takimata sanctus est <br>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
                sadipscing
                elitr, sed diam
                nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                accusam et
                justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor
                sit
                amet.</p>
        </div>
        <!-- Speisen -->
        <div>
            <h2 id="speisen">Köstlichkeiten, die Sie erwarten</h2>
            <table class="center">
                <tr>
                    <th>Name</th>
                    <th>Preis intern</th>
                    <th>Preis extern</th>
                    <th>Allergen</th>
                </tr>
                <?php
                if (!$dbError) {
                    while ($row = mysqli_fetch_assoc($gerichte_db_res)) {
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['preis_intern'] . '</td>';
                        echo '<td>' . $row['preis_extern'] . '</td>';
                        $allergene = getAllergensById($row['id'], $link);
                        $allergene_codes = array();
                        while ($row2 = mysqli_fetch_assoc($allergene)) {
                            array_push($allergene_codes, $row2['code']);
                        }
                        echo '<td>';
                        if (empty($allergene_codes)) echo "Keine Allergene";
                        else {
                            foreach ($allergene_codes as $value) {
                                echo $value . ', ';
                            }
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                    mysqli_free_result($gerichte_db_res);
                    mysqli_close($link);
                } else {
                    echo "<span style='color:red'>$dbError</span>";
                }
                ?>
            </table>
        </div>
        <!-- Zahlen -->
        <div>
            <h2 id="zahlen">E-Mensa in Zahlen</h2>
            <table>
                <tr>
                    <!-- Noch nicht mit der Datenbank dynamisiert -->
                    <td><?php echo $besucherCount . " Besucher" ?></td>
                    <td><?php echo $newsletterCounter . " Anmeldungen zum Newsletter" ?></td>
                    <td><?php echo sizeof($gerichte) . " Gerichte" ?></td>
                </tr>
            </table>
        </div>
        <!-- Wichtig für uns -->
        <div>
            <h2 id="diuw">Das ist uns wichtig</h2>
            <ul>
                <li>Beste frische saisonale Zutaten</li>
                <li>Ausgewogene abwechslungsreiche Gerichte</li>
                <li>Sauberkeit</li>
            </ul>
        </div>
        <!-- Newsletter -->
        <div>
            <h2 id="kontakt">Interesse geweckt? Wir informieren Sie!</h2>
            <form action="index.php" method="post">
                <fieldset id="nlform">
                    <?php
                        if ($confirmed_msg != null) {
                            echo " <b style='color: green'>$confirmed_msg</b>";
                        }
                        else if($errorp != '') {
                            echo " <b style='color: red'>$errorp</b>";
                        }
                    ?>
                    <legend>Newsletter abonieren</legend>
                    <div>
                        <label for="name">Ihr Name:</label>
                        <input id="name" name="name" type="text" placeholder="Vorname">
                    </div>
                    <div>
                        <label for="email">Ihre Email:</label>
                        <input id="email" name="email" type="email" placeholder="">
                    </div>
                    <div>
                        <label for="sprache">Newsletter bitte in:</label>
                        <select id="sprache" name="sprache">
                            <option value="deutsch">Deutsch</option>
                            <option value="englisch">Englisch</option>
                        </select>
                    </div>
                    <div style="clear: both; width: 60%">
                        <input id="checkbox" type="checkbox" name="checkbox">
                        <label for="checkbox">Den Datenschutzbestimmungen stimme ich zu</label>
                    </div>
                    <div>
                        <input id="submit" name="submit" type="submit" value="Zum Newsletter anmelden">
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- Verabschiedung -->
        <div id="verabschiedung">
            <h2>Wir freuen uns auf Ihren Besuch!</h2>
        </div>
    </div>
    <hr>
    <!-- Footer -->
    <div id="footer">
        <div id="copyright" class="footer_innen_abstaende">
            &copy; E-Mensa GmbH
        </div>
        <div id="autor" class="footer_innen_abstaende">
            Hamdy Sarhan, Lukas Gonnermann
        </div>
        <div id="impressum" class="footer_innen_abstaende">
            <a href="index.php">Impressum</a>
        </div>
    </div>
</div>
</body>
</html>