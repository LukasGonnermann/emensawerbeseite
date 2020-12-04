<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "kategorie"
 */
function db_kategorie_select_all() {
    $link = connectdb();

    $sql = "SELECT * FROM emensawerbeseite.kategorie";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function namen_sort(){
    $link = connectdb();
    $sql = "SELECT name FROM emensawerbeseite.kategorie   ORDER BY name ASC ;";
    $result = mysqli_query($link, $sql);

    $data2 = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);
    return $data2;

}