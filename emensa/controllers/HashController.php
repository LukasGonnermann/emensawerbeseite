<?php
require_once '../models/hash.php';

class HashController {
    // beenden ?
    public function HashCalc() {
        $textHash = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['hashTest'])) {
                $text = $_POST['hashTest'];
                $textHash = getPwHashWithSalt($text);
                array_push($retArr, $textHash);
            }
        }
        return view("hash.hashCalc", ['textHash' => $textHash]);
    }
}

?>