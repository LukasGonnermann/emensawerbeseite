<?php

namespace App\Http\Controllers;

use App\Models\BewertungModel;
use App\Models\GerichtModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class GerichtBewertungController extends BaseController
{
    public function bewertung(Request $request) {
        if ($request->session()->get('login_ok')) {
            $gerichtid = $request->input('gerichtid');
            $gericht = GerichtModel::query()->find($gerichtid);
            $context = [
                'gerichtid' => $gericht->id,
                'gerichtname' => $gericht->name,
                'gerichtbildname' => $gericht->bildname,
            ];
            /*echo "<pre>";
            var_dump($gericht);
            echo "</pre>";*/
            return view('bewertung.bewertung_form', $context);
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
                DB::insert("INSERT INTO emensawerbeseite.bewertung (bemerkung, sterne_bewertung) VALUES (?,?)",[$bemerkung,$sterne]);
                $bewertungid = DB::select("SELECT bewertung_id FROM bewertung ORDER BY bewertung_id DESC LIMIT 1");
                $bewertungid = $bewertungid[0]->bewertung_id;
                DB::insert("INSERT INTO emensawerbeseite.gericht_hat_bewertung (gericht_id, bewertung_id) VALUES (?,?)", [$gerichtid,$bewertungid]);
                DB::insert("INSERT INTO emensawerbeseite.benutzer_hat_bewertung (benutzer_id, bewertung_id) VALUES (?,?)", [$userId,$bewertungid]);
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

    public function bewertung_loeschen(Request $request) {
        if ($request->session()->get('login_ok')) {
            $bewertung_id = $request->input('bewertung_id');
            $bewertung = BewertungModel::find($bewertung_id);
            $bewertung->delete();
            return redirect('/meinebewertungen');
        }
        else {
            return redirect('/anmeldung');
        }
    }

    public function bewertungen(Request $request) {
        if ($request->session()->get('login_ok')) {
            $userid = session()->get('id');
            $bewertungen = DB::select("SELECT * from emensawerbeseite.bewertung
                        JOIN emensawerbeseite.benutzer_hat_bewertung bhb on bewertung.bewertung_id = bhb.bewertung_id
                         WHERE bhb.benutzer_id = ? ORDER BY sterne_bewertung DESC LIMIT 30 OFFSET 0;", [$userid]);
            return view('bewertung.bewertungen', ['bewertungen' => $bewertungen]);
        }
        else {
            return redirect('/anmeldung');
        }
    }

    public function hervorheben(Request $request) {
        if ($request->session()->get('login_ok')) {
            $bewertung_id = $request->input('bewertung_id');
            $bewertung = BewertungModel::find($bewertung_id);
            $bewertung->hervorhebung = 1;
            $bewertung->save();
            return redirect('/bewertungen');
        }
        else {
            return redirect('/anmeldung');
        }
    }

    public function nicht_hervorheben(Request $request) {
        if ($request->session()->get('login_ok')) {
            $bewertung_id = $request->input('bewertung_id');
            $bewertung = BewertungModel::find($bewertung_id);
            $bewertung->hervorhebung = 0;
            $bewertung->save();
            return redirect('/bewertungen');
        }
        else {
            return redirect('/anmeldung');
        }
    }

    private function getGerichtNameBild($gerichtid) {
        return DB::select("SELECT id,name, bildname FROM emensawerbeseite.gericht WHERE gericht.id = ?", [$gerichtid]);
    }

    private function checkInputs ($sterne, $bewertung): bool {
        return ($sterne > 0 && $sterne < 5) && (strlen($bewertung) <= 300);
    }

}
