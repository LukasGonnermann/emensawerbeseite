<?php
function getPwHashWithSalt($pw) {
    $salt = "praktSalt";
    return sha1($salt . $pw);
}
$pw = "superPass01!";
$pwHash = getPwHashWithSalt($pw);
var_dump($pwHash);
?>