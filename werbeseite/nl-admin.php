<?php
/**
 * Praktikum DBWT. Autoren:
 * Lukas, Gonnermann, 3218299
 * Hamdy, Sarhan, 3251443
 */

$file = file('gespeichert.csv');
const GET_PARAM_SEARCH_NAME = 'ByName';
const GET_PARAM_SEARCH_EMAIL = 'ByEmail';
const GET_PARAM_NAME = 'SearchName';

foreach($file as $zeile) {
    $sort[] = explode(",",$zeile);
}

$name = array_column($sort, 1);
$email = array_column($sort, 2);
if(isset($_GET[GET_PARAM_NAME]))
{
    $G = $_GET[GET_PARAM_NAME];
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>nl_admin</title>
    <style type="text/css">
        table, th, td {
            border: 1px solid black;
        }

    </style>
</head>
<body>
<form method="get">
    <input type="submit" name="ByName" value="Sortierung nach Name">
    <br>
    <br>
    <input type="submit" name="ByEmail" value="Sortierung nach E-Mail">
</form>
<br>
<form method="get">

    <label for="search_name">Search a name:</label>
    <input id="search_text" type="text" name="SearchName" value="<?=htmlspecialchars($G);?>">

    <input type="submit" value="Search">
    <table>
        <th>Nummer</th> <th>Name</th> <th>E-Mail</th> <th>Sprache</th> <th>Datenschutzstatus</th>
        <tr>
            <?php

            $filter = [];
            if(isset($G))
            {
                $searchName = $G;
                foreach ($sort as $form) {
                    if (strpos(strtolower($form[1]), strtolower($G)) !== false) {
                        $filter[] = $form;
                    }
                }


                foreach ($filter as $element) {
                    echo "<tr>",
                        "<td>$element[0]</td>".
                        "<td>$element[1]</td>".
                        "<td>$element[2]</td>".
                        "<td>$element[3]</td>".
                        "<td>$element[4]</td>".
                        "</tr>";
                }


                '</tr>';

                '<tr>';
            }
            else  {


                foreach ($sort as $form) {
                    if (!isset($_GET[GET_PARAM_SEARCH_NAME]) && !isset($_GET[GET_PARAM_SEARCH_EMAIL])) {
                        echo "<tr>",
                            "<td>$form[0]</td>" .
                            "<td>$form[1]</td>" .
                            "<td>$form[2]</td>" .
                            "<td>$form[3]</td>" .
                            "<td>$form[4]</td>" .
                            "</tr>";
                    }
                }
                if (isset($_GET[GET_PARAM_SEARCH_NAME])) {
                    array_multisort($name, SORT_STRING, $sort);
                    foreach ($sort as $form) {
                        echo "<tr>",
                            "<td>$form[0]</td>" .
                            "<td>$form[1]</td>" .
                            "<td>$form[2]</td>" .
                            "<td>$form[3]</td>" .
                            "<td>$form[4]</td>" .


                            "</tr>";
                    }
                }
                if (isset($_GET[GET_PARAM_SEARCH_EMAIL])) {
                    array_multisort($email, SORT_STRING, $sort);
                    foreach ($sort as $form) {
                        echo "<tr>",
                            "<td>$form[0]</td>" .
                            "<td>$form[1]</td>" .
                            "<td>$form[2]</td>" .
                            "<td>$form[3]</td>" .
                            "<td>$form[4]</td>" .
                            "</tr>";
                    }
                }
            }
            ?>
        </tr>
    </table>
</form>
</body>
</html>