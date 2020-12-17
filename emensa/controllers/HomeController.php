<?php
require_once('../models/gericht.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request) {
        $gerichte = db_gerichte_select_amount_asc(5);

        $bilder = [];
        $allergene = [];

        foreach ($gerichte as $gericht) {
            $allergen = getAllergensById($gericht['3']);
            $allergene_codes = array();
            while ($row = mysqli_fetch_assoc($allergen)) {
                array_push($allergene_codes, $row['code']);
            }
            array_push($allergene, $allergene_codes);


        }
        $legende = [];
        foreach ($allergene as $key => $allergen) {
            foreach ($allergen as $value)
            if (!in_array($value, $legende)) array_push($legende, $value);
        }

        return view('home.index', [
            'title' => "E-Mensa Startseite",
            'gerichte' => $gerichte,
            'allergene' => $allergene,
            'allergene_legende' => $legende,




        ]);
    }

    public function home(RequestData $request) {
        return view('home.index', ['rd' => $request ]);
    }
}