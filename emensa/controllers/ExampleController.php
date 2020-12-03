<?php
require_once('../models/kategorie.php');

class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd) {
        // ...
        return view('examples.m4_6a_queryparameter', ['rd' => $rd ]);


    }
    public function m4_6b_kategorie() {
        $data2 = namen_sort();
        // ...
        return view('examples.m4_6b_kategorie', ['data' => $data2 ]);


    }
    public function m4_6c_gerichte () {
        $data2 = db_gericht_select_np();
        // ...
        return view('examples.m4_6c_gerichte', ['data' => $data2 ]);


    }
}