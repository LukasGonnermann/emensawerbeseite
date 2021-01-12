<?php


namespace App\Models;


use Illuminate\Support\Facades\DB;

class AnmeldungModel extends \Illuminate\Database\Eloquent\Model
{

    public function verify($email, $password) {
        $passwordHash = sha1('praktSalt' . $password);

        $dbUser = DB::select('SELECT id, email, passwort FROM benutzer WHERE email = ?', [$email]);

    }
}
