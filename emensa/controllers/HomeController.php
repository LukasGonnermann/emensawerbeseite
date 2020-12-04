<?php
require_once('../models/gericht.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request) {
        $gerichte = db_gerichte_select_amount_asc(5);
        return view('home.index', ['title' => "E-Mensa Startseite", 'gerichte' => $gerichte]);
    }

    public function home(RequestData $request) {
        return view('home.index', ['rd' => $request ]);
    }
}