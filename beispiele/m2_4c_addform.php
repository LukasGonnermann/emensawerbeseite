<?php
/**
 * Praktikum DBWT. Autoren:
 * Lukas, Gonnermann, 3218299
 * Hamdy, Sarhan, 3251443
 */
include 'm2_4a_stanardparameter.php';
function multi($a, $b = 1) {
    return (double) $a * (double) $b;
}
$mode = "";
$res = 0;
$error = null;
$submitted = false;
if (isset($_POST['add'])) {
    $mode = "Addition";
    $res = addiere($_POST['a'], $_POST['b']);
    $submitted = true;
}
elseif (isset($_POST['mult'])) {
    $mode = "Multiplikation";
    $res = multi($_POST['a'], $_POST['b']);
    $submitted = true;
}
elseif (isset($_POST['reset'])) {
    $submitted = false;
}
else {
    $error = "Ein Fehler ist aufgetreten";
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Add Form</title>
</head>
<body>
<form method="post">
    <fieldset>
        <legend>Addieren und Multiplizieren</legend>
        <label for="a">a: </label>
        <input id="a" type="text" name="a" placeholder="<?php echo $_POST['a']?>">
        <label for="b">b: </label>
        <input id="b" type="text" name="b" placeholder="<?php echo $_POST['a']?>">
        <br>
        <br>
        <input id="add" type="submit" name="add" value="Addieren!">
        <input id="mult" type="submit" name="mult" value="Multiplizieren!">
        <input id="reset" type="submit" name="reset" value="Reset">
    </fieldset>
</form>
<h2>
    <?php if (!isset($error) && $submitted) {
        echo "Das Ergebnis der $mode ist: $res";
    }
    elseif ($submitted){
        echo $error;
    }
        ?>
</h2>

</body>
</html>
