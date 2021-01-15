<?php

namespace App\Http\Controllers;


use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class AnmeldungController extends BaseController
{
    public function larademo(Request $request) {
        return "Hello World";
    }

    public function anmeldung(Request $request): string
    {
        $context = [
            'title' => "E-Mensa Anmeldung",
            'msg' => $request->session()->get('login_result_message', null),
        ];

        return view("anmeldung.anmeldung", $context);
    }

    public function anmeldung_verifizieren(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $verified = $this->verifizieren($email, $password);
        if ($verified) {
            $request->session()->put('login_ok', true);
            $request->session()->put('name', $email);
            logger()->info("User: " . $email . " logged in!");
            return redirect('/');
        }
        else {
            $request->session()->put('login_result_message', "Benutzer oder Passwort Falsch!");
            return redirect('/anmeldung');
        }
    }

    public function abmelden(Request $request) {
        $request->session()->flush();
        return redirect('/');
    }

    private function verifizieren($email, $password) {
        $salt = "praktSalt";
        $pwHash = sha1($salt . $password);

        $dbUser = DB::table('benutzer')->where('email', $email)->first();
        if ($dbUser->passwort == $pwHash) {
            if ($dbUser->admin) {
                session()->put('admin', true);
            }
            session()->put('id', $dbUser->id);
            return true;
        }
        else {
            return false;
        }
    }
}
