<!DOCTYPE html>
<html lang="de">
<head>
    <title>Kategorie</title>
</head>
<body>
<ul>
    @if ($kategorie_data)
        @foreach($kategorie_data as $name)
            <li>{{ $name['name'] }}</li>
        @endforeach

    @endif

</ul>
</body>
</html>