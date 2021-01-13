<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\Pure;

class GerichtBewertungController extends BaseController
{
    public function bewertung(Request $request) {
        if ($request->session()->get('login_ok')) {
            // Get Gericht Data
            $gericht = $this->getGerichtNameBild($request->input('gerichtid'));
            return view('bewertung.bewertung_form', ['gericht' => $gericht[0]]);
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
            $gerichtid = $request->input('gerichtid');
            if ($this->checkInputs($sterne, $bemerkung)) {
                // insert into databank
                DB::beginTransaction();
                DB::insert("INSERT INTO bewertung (bemerkung, sterne_bewertung) VALUES (?,?)",[$bemerkung,$sterne]);
                $bewertungid = DB::select("SELECT bewertung_id FROM bewertung ORDER BY bewertung_id DESC LIMIT 1");
                $bewertungid = $bewertungid[0]->bewertung_id;
                DB::insert("INSERT INTO gericht_hat_bewertung (gericht_id, bewertung_id) VALUES (?,?)", [$gerichtid,$bewertungid]);
                DB::insert("INSERT INTO benutzer_hat_bewertung (benutzer_id, bewertung_id) VALUES (?,?)", [$userId,$bewertungid]);
                DB::commit();
                return redirect('/bewertung_success');
            }
            else {
                $request->session()->flash('bewertung_msg', "Eingabe ungültig!");
                return view('bewertung.bewertung_form', []);
            }
        }
    }

    public function bewertung_success(Request $request) {
        return view('bewertung.bewertung_success',[]);
    }

    public function bewertung_error() {

    }

    private function getGerichtNameBild($gerichtid) {
        return DB::select("SELECT id,name, bildname FROM emensawerbeseite.gericht WHERE gericht.id = ?", [$gerichtid]);
    }

    private function checkInputs ($sterne, $bewertung): bool {
        return ($sterne > 0 && $sterne < 5) && (strlen($bewertung) <= 300);
    }
}
