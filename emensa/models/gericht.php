<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all() {
    $link = connectdb();

    $sql = "SELECT id, name, beschreibung FROM emensawerbeseite.gericht ORDER BY name";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function db_gericht_select_np() {

    $link = connectdb();
    $sql = "SELECT name, preis_intern FROM emensawerbeseite.gericht WHERE preis_intern > 2 ORDER BY name ASC";
    $result = mysqli_query($link, $sql);
    mysqli_close($link);
    if($result) {
        return mysqli_fetch_all($result, MYSQLI_BOTH);
    }
    else return false;
}

