<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class GerichtBewertungController extends BaseController
{
    public function bewertung(Request $request) {
        if ($request->session()->get('login_ok')) {
            return view('bewertung.bewertung_form', []);
        }
        else {
            return redirect('/anmeldung');
        }
    }

    public function bewertung_verifizieren(Request $request) {
        if ($request->session()->get('login_ok')) {
            $sterne = $request->input('sterne');
            $bemerkung = $request->input('bemerkung');
            $userId = session()->get('id');
            if ($this->checkInputs($sterne, $bemerkung)) {
                DB::beginTransaction();
                DB::insert("INSERT INTO emensawerbeseite.bewertung (bemerkung, sterne_bewertung) VALUES (?,?)", [$sterne, $bemerkung]);
                DB::commit();
                return redirect('/');
            }
            else {
                $request->session()->flash('bewertung_msg', "Eingabe ungültig!");
                return view('bewertung.bewertung_form', []);
            }
        }
        else {
            return redirect('/anmeldung');
        }
    }

    private function checkInputs ($sterne, $bewertung): bool {
        return ($sterne > 0 && $sterne < 5) && (strlen($bewertung) < 300);
    }
}
