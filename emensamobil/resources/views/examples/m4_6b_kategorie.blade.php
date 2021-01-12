<!DOCTYPE html>
<html lang="de">
<head>
    <title>Kategorie</title>
</head>
<body>
<ul>
    @if ($kategorie_data)
        @forelse($kategorie_data as $key=>$name)
            @if($key % 2 == 0)
                <li>{{ $name['name'] }}</li>
            @else
                <li style="font-weight: bold">{{ $name['name'] }}</li>
            @endif
        @empty
            <li>Keine Daten</li>
        @endforelse
    @endif
</ul>
</body>
</html>