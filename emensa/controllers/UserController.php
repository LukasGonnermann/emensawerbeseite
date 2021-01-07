<?php
require_once ('../models/user.php');

class UserController {
    public function profile(RequestData $requestData) {
        $data = null;

        if ($_SESSION['login_ok']) {
            $data = getProfileData($_SESSION['name']);
        }
        else {
            header('Location: /anmeldung');
        }
        return view('user.user_profile', $data);
    }
}