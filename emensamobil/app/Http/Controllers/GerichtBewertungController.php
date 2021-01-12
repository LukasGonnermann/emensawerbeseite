<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

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
}
