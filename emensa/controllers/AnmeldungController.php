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
            $_SESSION['login_ok'] = true;
            $target = $_SESSION['target'];
            $_SESSION['name'] = $email;
            header('Location: /' . $target);
        } else {
            $_SESSION['login_result_message'] = 'Benutzer- oder Passwort falsch!';
            header('Location: /anmeldung');
        }

    }

    public function abmelden(RequestData $request) {
        session_destroy();
        header('Location: /');
    }
}