<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    public function profil(Request $request) {
        $userdata = null;

        if ($request->session()->get('login_ok')) {
            $data = $this->getProfileData($request->session()->get('name'));
            $userdata = [
                'email' => $data[0]->email,
                'anzahlanmeldungen' => $data[0]->anzahlanmeldungen,
                'admin' => $data[0]->admin,
            ];
        }
        else {
            return redirect('/anmeldung');
        }
        return view('user.user_profile', $userdata);
    }

    public function meine_bewertungen(Request $request) {
        if ($request->session()->get('login_ok')) {
            //$userid = DB::select("");
            $userid = 1;
            $bewertungen = DB::select("SELECT * from bewertung
                        JOIN benutzer_hat_bewertung bhb on bewertung.bewertung_id = bhb.bewertung_id
                        WHERE bhb.benutzer_id = ?;", [$userid]);
            return view('user.user_bewertungen', ['bewertungen' => $bewertungen]);
        }
        else {
            return redirect('/');
        }
    }

    private function getProfileData($user_email) {
        return DB::select("SELECT email, anzahlanmeldungen, admin FROM emensawerbeseite.benutzer WHERE email = ?", [$user_email]);
    }
}
