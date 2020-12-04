<?php
require_once('../models/gericht.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request) {
        $gerichte = db_gerichte_select_amount_asc(5);
        $allergene = [];
        foreach ($gerichte as $gericht) {
            $allergen = getAllergensById($gericht['3']);
            $allergen = mysqli_fetch_assoc($allergen);
            array_push($allergene, $allergen);
        }
        return view('home.index', ['title' => "E-Mensa Startseite",'gerichte' => $gerichte, 'allergene' => $allergene]);
    }

    public function home(RequestData $request) {
        return view('home.index', ['rd' => $request ]);
    }
}