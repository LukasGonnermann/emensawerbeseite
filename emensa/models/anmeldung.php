<?php
require_once ('hash.php');

function verify($email, $password): bool
{
    $pwHash = getPwHashWithSalt($password);
    $link = connectdb();

    $query = "SELECT id, email, passwort FROM benutzer WHERE email = '$email'";
    mysqli_begin_transaction($link);
    $result =  mysqli_query($link, $query);
    mysqli_commit($link);
    $resultAssocArray = mysqli_fetch_assoc($result);
    $id = $resultAssocArray['id'];

    if ($pwHash == $resultAssocArray['passwort']) {
        mysqli_begin_transaction($link);
        // $_SESSION['user_id'] = $id;
        $link->query("CALL increment_erfolg_anmeldung($id)");
        $link->query("UPDATE benutzer SET letzteanmeldung = now()");
        mysqli_commit($link);
        return true;
    }
    else {
        //$link->query("UPDATE benutzer SET anzahlfehler = anzahlfehler + 1");
        mysqli_begin_transaction($link);
        $link->query("UPDATE benutzer SET letzterfehler = now()");
        mysqli_commit($link);
        return false;
    }

}
