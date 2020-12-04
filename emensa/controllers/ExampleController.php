<?php
require_once('../models/kategorie.php');
require_once('../models/gericht.php');

class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd)
    {
        $name = $_GET['name'];
        return view('examples.m4_6a_queryparameter', ['name' => $name]);
    }

    public function m4_6b_kategorie()
    {
        $kategorie_data = namen_sort();
        // ...
        return view('examples.m4_6b_kategorie', ['kategorie_data' => $kategorie_data]);
    }

    public function m4_6c_gerichte()
    {
        $gericht_data = db_gericht_select_np();
        return view('examples.m4_6c_gerichte', ['gericht_data' => $gericht_data]);
    }

    public function m4_6d_layout()
    {
        if ($_GET['no'] == 2) return view('examples.pages.m4_6d_page_2',['title'=> "Cool Title"]);
        return view('examples.pages.m4_6d_page_1',['title'=> "This is Page1"]);
    }
}