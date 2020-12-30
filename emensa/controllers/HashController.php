<?php
require_once '../models/hash.php';

class HashController {
    // beenden ?
    public function hashCalc(RequestData $rd) {
        $pw = getPwHashWithSalt($rd->query['pw']);
        echo $pw;
    }
}

?>