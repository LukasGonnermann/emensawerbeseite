
<?php

/**
 * Praktikum DBWT. Autoren:
 * Lukas, Gonnermann, 3218299
 * Hamdy, Sarhan, 3251443
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
}

else {
    $gerichteFileError = "Gerichte fileopen error";
}

/**
 * Besucher calc Section
 */
$file = fopen('besuche.txt', 'r');
$besucherCount = fgets($file, 1000);
fclose($file);
$besucherCount = abs(intval($besucherCount) + 1);
$file = fopen('besuche.txt', 'w');
fwrite($file, $besucherCount);
fclose($file);

/**
 * Newsletteranmeldungen
 * TODO
 * Diese Funktion ist nicht wirklich vertrauenswürdig, andere Lösung finden!
 */
$file = fopen('newsletter.txt', 'r');
$newsletterCounter = fgets($file, 1024);
if ($newsletterCounter !== False) {
    $newsletterCounter = abs(intval($newsletterCounter));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newsletterCounter++;
    $file = fopen('newsletter.txt', 'w');
    fwrite($file, $newsletterCounter);
}

/**
 * Newsletteranmeldung
 */
$errorp = '';
$namep = '';
$emailp = '';
$sprachep = '';
$datenp = '';

if (!isset($_POST['submit'])) {

    $error = 'Error';
}
else {
if (!empty($_POST['name'])) {
    $namep = $_POST['name'];

} else {
    $errorp = 'Bitte Ihre Name eingeben!';

}
if (!empty($_POST['email'])) {
    $emailp = $_POST['email'];

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
        $fileopen = fopen("gespeichert.csv", "a");
        $no_rows = count(file("gespeichert.csv"));

        $form_data = array(
            's_n' => $no_rows,
            'n' => $namep,
            'e' => $emailp,
            'sp' => $sprachep,
            'd' => $datenp,

        );
        fputcsv($fileopen, $form_data);
        echo '<span style="color:green";>Daten erfolgreich gespeichert!</span>';

    }


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

                <?php
                    /*foreach ($gerichte as $key => $value) {
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
                    }*/?>


                  <table class="center" >
                <tr>
                    <th>Name</th>
                    <th>Preis intern</th>
                    <th>Preis extern</th>
                    <th>Allergen</th>
                </tr>
                      <?php
                $link = mysqli_connect(
                    "127.0.0.1", // Host der Datenbank
                    "root",                 // Benutzername zur Anmeldung
                    "1234",    // Passwort
                    "emensawerbeseite", // Auswahl der Datenbanken (bzw. des Schemas)
                    3306

// optional port der Datenbank
                );


                $mysqli= "SELECT name,preis_intern,preis_extern,id 
                          FROM gericht 
                          ORDER BY name ASC LIMIT 5;";
                      $result = mysqli_query($link, $mysqli);

                      while ($row = mysqli_fetch_assoc($result)) {

                          echo '<tr>';
                          echo '<th>'. $row['name']. '</th>';
                          echo '<th>'. $row['preis_intern']. '</th>';
                          echo '<th>'. $row['preis_extern'].'</th>';
                          $id=$row['id'];
                          $mysqli2 = "SELECT code 
                                      FROM gericht_hat_allergen 
                                      WHERE gericht_id =$id";
                          $result2 = mysqli_query($link, $mysqli2);

                          $allergen = array();
                          while ($row2 = mysqli_fetch_assoc($result2)) {
                              array_push($allergen,$row2['code']);
                          }
                          echo '<th>';
                          $k="Keine Allergen";
                          foreach ($allergen as $value){
                              if(!isset($value)){

                                  echo '<b>Keine Value</b>';
                              }
                              else{
                                  echo  $value .', ';
                              }
                          }

                          '</th>';
                          echo '</tr>';
                      }




                mysqli_free_result($result);
                mysqli_close($link);


                ?>
            </table>
        </div>
        <!-- Zahlen -->
        <div>
            <h2 id="zahlen">E-Mensa in Zahlen</h2>
            <table>
                <tr>
                    <td><?php echo $besucherCount . " Besucher" ?></td>
                    <td><?php echo $newsletterCounter . " Anmeldungen zum Newsletter" ?></td>
                    <td><?php echo sizeof($gerichte) . " Gerichte"?></td>
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
                    <b style="color: red"><?php echo $errorp ?></b>
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
                        <input id="lang" type="text" value="" hidden>
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