<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=$WIDTH$, user-scalable=$SCALABLE$, initial-scale=$INITIAL_SCALE$, maximum-scale=$MAX_SCALE$, minimum-scale=$MIN_SCALE$">
    <title>Hash Calculator</title>
</head>
<body>
<form>
    <fieldset>
        <legend>Hash Calculator (Noch nicht fertig)</legend>
        <label>Text welcher berechnet werden soll: </label>
        <input id="hashText" type="text" name="hashText"><br>
        <input id="submit" type="submit" value="Anfrage Senden">
    </fieldset>
</form>
<p>{{ $textHash }}</p>
</body>
</html>