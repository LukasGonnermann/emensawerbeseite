<!DOCTYPE html>
<html lang="de">
<head>
    <title>Hello</title>
</head>
<body>
<ul>
    @if ($gericht_data)
        @foreach($gericht_data as $gericht)
            <li>{{ $gericht['name'] . " " . $gericht['preis_intern'] }}</li>
        @endforeach
    @else
        <li>Es sind keine Gerichte vorhanden</li>
    @endif

</ul>
</body>
</html>