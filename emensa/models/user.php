<?php

function getProfileData($paramEmail) {
    if (!$link = connectdb()) {
        echo "Ein Datenbank fehler ist aufgetreten";
    }
    $data = $link->query("SELECT email, anzahlanmeldungen, admin FROM emensawerbeseite.benutzer WHERE email = '$paramEmail'");
    return mysqli_fetch_assoc($data);
}