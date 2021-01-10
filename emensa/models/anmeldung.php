<?php
require_once ('hash.php');

function verify($email, $password): bool
{
    // Cleanup
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);

    $pwHash = getPwHashWithSalt($password);
    $link = connectdb();
    $result = null;
    mysqli_begin_transaction($link);
    if (!$stmt = $link->prepare("SELECT id, email, passwort, anzahlanmeldungen, admin FROM benutzer WHERE email = ?")) {
        mysqli_rollback($link);
        return false;
    }
    if (!$stmt->bind_param('s', $email)) {
        mysqli_rollback($link);
        return false;
    }
    if (!$stmt->execute()) {
        mysqli_rollback($link);
        return false;
    }
    else {
        $result = $stmt->get_result();
    }
    $resultAssocArray = mysqli_fetch_assoc($result);
    $id = $resultAssocArray['id'];

    if ($pwHash == $resultAssocArray['passwort']) {

        if(!$link->query("CALL increment_erfolg_anmeldung($id)")) {
            mysqli_rollback($link);
            return false;
        }
        if(!$link->query("UPDATE benutzer SET letzteanmeldung = now()")) {
            mysqli_rollback($link);
            return false;
        }
        mysqli_commit($link);
        return true;
    }
    else {
        //$link->query("UPDATE benutzer SET anzahlfehler = anzahlfehler + 1");
        if (!$link->query("UPDATE benutzer SET letzterfehler = now()")) {
            mysqli_rollback($link);
            return false;
        }
        mysqli_commit($link);
        return false;
    }

}
