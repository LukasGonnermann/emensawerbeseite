<?php
/**
 * Praktikum DBWT. Autoren:
 * Lukas, Gonnermann, 3218299
 * Hamdy, Sarhan, 3251443
 */
$error = null;
$gerichte = [];
if (($file = fopen('gerichte.CSV', 'r')) !== FALSE) {
    while (($data = fgetcsv($file, 1000, ';')) !== FALSE) {
        if ((count($data) == 4)) {
            array_push($gerichte, $data);
        }
    }
}
else {
    $error = "Fileopen Error";
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <link href="ind_style.css" rel="stylesheet">
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
                    <th>Beschreibung</th>
                    <th>Preis intern</th>
                    <th>Preis extern</th>
                    <th>Bilder</th>
                </tr>
                <?php
                    foreach ($gerichte as $key => $value) {
                        echo "<tr>";
                            for ($i = 0; $i < count($value) - 1; $i++) {
                                if ($i == 0) {
                                    echo "<td>$value[$i]</td>";
                                }
                                else {
                                    echo "<td>$value[$i]€</td>";
                                }

                            }
                            // TODO
                            echo "<td><img src='$value[3]' alt='Gericht: $value[3]' width='75px' height='75px'></td>";
                        echo "</tr>";
                    }

                ?>
            </table>
        </div>
        <!-- Zahlen -->
        <div>
            <h2 id="zahlen">E-Mensa in Zahlen</h2>
            <table>
                <tr>
                    <td>500 Besuche</td>
                    <td>200 Anmeldungen zum Newsletter</td>
                    <td>50 Speisen</td>
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
                    <legend>Newsletter abonieren</legend>
                    <div>
                        <label for="name">Ihr Name:</label>
                        <input id="name" type="text" placeholder="Vorname">
                    </div>
                    <div>
                        <label for="email">Ihre Email:</label>
                        <input id="email" type="email" placeholder="">
                    </div>
                    <div>
                        <label for="sprache">Newsletter bitte in:</label>
                        <select id="sprache">
                            <option value="deutsch">Deutsch</option>
                            <option value="englisch">Englisch</option>
                        </select>
                    </div>
                    <div style="clear: both; width: 60%">
                        <input id="checkbox" type="checkbox" name="checkbox">
                        <label for="checkbox">Den Datenschutzbestimmungen stimme ich zu</label>
                    </div>
                    <div>
                        <input id="submit" type="submit" value="Zum Newsletter anmelden" disabled>
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