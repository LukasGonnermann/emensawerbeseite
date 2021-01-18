<?php

namespace App\Http\Controllers;
use App\Models\BewertungModel;
use App\Models\GerichtModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;


class HomeController extends BaseController
{
    public function ormdemo(Request $request) {
        $gericht = GerichtModel::find(1);
        $gericht->vegetarisch = "Ja";
        echo "<pre>";
        var_dump($gericht);
        echo "</pre>";
        $gericht->save();
    }


    public function index(Request $request)
    {
        $gerichte = $this->db_gerichte_select_amount_asc();
        $allergene = [];


        foreach ($gerichte as $gericht) {
            $allergen = $this->getAllergensById($gericht->bildname);
            $allergene_codes = array();
            foreach ($allergen as $all) {
                array_push($allergene_codes, $all->code);
            }
            array_push($allergene, $allergene_codes);

        }
        $legende = [];
        foreach ($allergene as $key => $allergen) {
            foreach ($allergen as $value)
                if (!in_array($value, $legende)) array_push($legende, $value);
        }

        // Get Hervorgehobene Bewertungen
        $bewertungen = DB::select("SELECT bemerkung, sterne_bewertung, g.name FROM emensawerbeseite.bewertung
                                        LEFT JOIN gericht_hat_bewertung ghb on bewertung.bewertung_id = ghb.bewertung_id
                                        LEFT JOIN gericht g on ghb.gericht_id = g.id
                                        WHERE hervorhebung = 1");

        $context =  [
            'title' => "E-Mensa Startseite",
            'gerichte' => $gerichte,
            'allergene' => $allergene,
            'allergene_legende' => $legende,
            'bewertungen' => $bewertungen,
        ];

        // for debugging
        //print('<pre>'.print_r($context,true).'</pre>');
        return view('home.index', $context);
    }

    public function home(Request $request) {
        return view('home.index', ['rd' => $request ]);
    }

    private function  db_gerichte_select_amount_asc($amount = 5) {
        return \Illuminate\Support\Facades\DB::select('SELECT name,preis_intern,preis_extern,id,bildname
                          FROM emensawerbeseite.gericht
                          ORDER BY name ASC LIMIT ?;',[$amount]);
    }

    public function getAllergensById($id)
    {
        return DB::select('SELECT code FROM gericht_hat_allergen WHERE gericht_id = ?',[$id]);
    }
}
