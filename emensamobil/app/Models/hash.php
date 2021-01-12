<?php
function getPwHashWithSalt($pw): string
{
    $salt = "praktSalt";
    return sha1($salt . $pw);
}
?>