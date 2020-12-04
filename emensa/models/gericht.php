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

function db_getAllergensById($id, $link)
{
    $link = connectdb();
    // DB Query
    $query =    "SELECT code 
                FROM gericht_hat_allergen 
                WHERE gericht_id =$id";
    mysqli_close($link);
    return mysqli_query($link, $query);
}

function db_getAllergensByGerichte($gerichte)
{
    $link = connectdb();
    $allergene =  [];
    foreach($gerichte as $gericht) {
        $allergen = db_getAllergensById($gericht['id']);
        if ($allergen) {
            array_push($allergene,$allergen);
        }
        else array_push($allergene,"Keine Allergene");
    }
    return $allergene;
}

function db_gerichte_select_amount_asc($amount) {
    $link = connectdb();
    $query = "SELECT name,preis_intern,preis_extern,id 
                          FROM gericht 
                          ORDER BY name ASC LIMIT $amount;";
    $gerichte_db_res = mysqli_query($link, $query);
    mysqli_close($link);
    return mysqli_fetch_all($gerichte_db_res);
}
