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
            $db_user_id = DB::select("SELECT id from emensawerbeseite.benutzer WHERE email = ?", [session()->get('name')]);
            $userid = $db_user_id[0]->id;
            $bewertungen = DB::select("SELECT name,bemerkung, sterne_bewertung, zeitpunkt, b.bewertung_id FROM gericht
JOIN gericht_hat_bewertung ghb on gericht.id = ghb.gericht_id
LEFT JOIN gericht_hat_bewertung g on gericht.id = g.gericht_id
LEFT JOIN bewertung b ON g.bewertung_id = b.bewertung_id
LEFT JOIN benutzer_hat_bewertung bhb on b.bewertung_id = bhb.bewertung_id
WHERE bhb.benutzer_id = ?;", [$userid]);
            return view('user.user_bewertungen', ['bewertungen' => $bewertungen]);
        }
        else {
            return redirect('/anmeldung');
        }
    }

    private function getProfileData($user_email) {
        return DB::select("SELECT email, anzahlanmeldungen, admin FROM emensawerbeseite.benutzer WHERE email = ?", [$user_email]);
    }
}
