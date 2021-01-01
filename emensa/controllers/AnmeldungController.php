<?php
require_once('../models/anmeldung.php');

class AnmeldungController
{
    public function anmeldung(RequestData $request): string
    {
        $context = [
            'title' => "E-Mensa Anmeldung",
            'msg' => $_SESSION['login_result_message'] ?? null,
        ];

        return view("anmeldung.anmeldung", $context);
    }

    public function anmeldung_verifizieren(RequestData $rd)
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $verified = verify($email, $password);

        $_SESSION['login_result_message'] = null;
        if ($verified) {
            logger()->info("Benutzer:" . $email . ", hat sich von der Adresse: " . $_SERVER['REMOTE_ADDR'] . " angemeldet");
            $_SESSION['login_ok'] = true;
            $_SESSION['name'] = $email;
            $target = $_SESSION['target'];
            header('Location: /' . $target);
        } else {
            $_SESSION['login_result_message'] = 'Benutzer- oder Passwort falsch!';
            logger()->warning("Benutzer: " . $email . ", Fehlgeschlagener Login. Verifizierung fehlgeschlagen. Remote Address: " . $_SERVER['REMOTE_ADDR']);
            header('Location: /anmeldung');
        }
    }

    public function abmelden(RequestData $request) {
        $email = $_SESSION['name'];
        session_destroy();
        logger()->info("Benutzer:" . $email . ", hat sich abgemeldet");
        header('Location: /');
    }
}