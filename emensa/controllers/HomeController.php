<?php
require_once('../models/gericht.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request) {
        $gerichte = [];
        $db_gerichte = db_gerichte_select_amount_asc(5);
        foreach ($db_gerichte as $gericht) {
            //$db_gericht_allergene = getAllergensById($gericht['3']);
            $resArr = [$gericht[0],$gericht[1],$gericht[2]];
            array_push($gerichte, $resArr);
        }
        return view('home.index', ['title' => "E-Mensa Startseite", 'gerichte' => $db_gerichte]);
    }

    public function home(RequestData $request) {
        return view('home.index', ['rd' => $request ]);
    }
}