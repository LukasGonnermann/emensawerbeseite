<?php

namespace salthash;
function getPwHashWithSalt($pw) {
    $salt = "praktSalt";
    return sha1($salt . $pw);
}

?>