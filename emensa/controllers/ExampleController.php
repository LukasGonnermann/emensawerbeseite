<?php
require_once('../models/kategorie.php');

class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd) {
        // ...
        return view('examples.m4_6a_queryparameter', ['rd' => $rd ]);


    }
    public function m4_6b_kategorie() {
        $data = namen_sort();
        // ...
        return view('examples.m4_6b_kategorie', ['context' => $data ]);


    }
    public function m4_6c_gerichte () {
        $data = db_gericht_select_np();
        // ...
        return view('examples.m4_6c_gerichte', ['context' => $data ]);


    }
}