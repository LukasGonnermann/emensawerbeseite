@extends('templates.base')

@section('page_title')
    {{ $title }}
@endsection

@section('css_path')
    {{ "css/base_style.css" }}
@endsection

@section('header')
    <div id="logo">
        <div>E-Mensa Logo</div>
    </div>
@endsection

@section('navigation')
    <div id="adressen">
        <a href="/">Ankündigungen</a>
        <a href="#speisen">Speisen</a>
        <a href="/">Zahlen</a>
        <a href="/">Wichtig für uns</a>
        <a href="/">Kontakt</a>
    </div>
@endsection
@section('user')
    <div id="user">
        @if($_SESSION['login_ok'])
            Angemeldet als: {{ $_SESSION['name'] }}
            <br>
            <a href="/abmeldung">Abmelden</a>
        @else
            <a href="/anmeldung">Anmelden</a>
        @endif

    </div>
@endsection

@section('main')
    <div id="placeholder">
        <h1>Wilkommen auf der E-Mensa Webseite</h1>
    </div>
    <div>
        <h2 id="ankuendigungen">Bald gibt es Essen auch online</h2>
        <p id="info">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
            ut labore
            et
            dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
            Stet
            clita kasd gubergren,
            no sea takimata sanctus est <br>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
            sadipscing
            elitr, sed diam
            nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
            accusam et
            justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor
            sit
            amet.</p>
    </div>
    <div>
        <h2 id="speisen">Köstlichkeiten, die Sie erwarten:</h2>
        <table class="center">
            <tr>
                <th>Name</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
                <th>Allergene</th>
                <th>Bild</th>
            </tr>
            @foreach($gerichte as $key => $gericht)
                <tr>
                    <td>{{ $gericht[0]}}</td>
                    <td>{{ number_format($gericht[1], 2) . "€" }}</td>
                    <td>{{ number_format($gericht[2], 2) . "€" }}</td>

                    <td>
                        @if($allergene[$key])
                            @foreach($allergene[$key] as $value)
                                {{ $value }}
                            @endforeach
                        @else
                            {{ "Keine Allergene" }}
                        @endif

                    </td>
                    <td><img src="http://localhost:9000/img/gerichte/{{$gericht[4]}}" width="70" height="70"></td>

                </tr>
            @endforeach

        </table>
    </div>
    <div id="#allergenLegende">
        <p>Alle enthaltenden Allergene:
            @foreach($allergene_legende as $key => $value)
                {{ $value . ", " }}
            @endforeach
        </p>
    </div>
    <!-- Wichtig für uns -->
    <div>
        <h2 id="diuw">Das ist uns wichtig</h2>
        <ul>
            <li>Beste frische saisonale Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
    </div>
    <!-- Verabschiedung -->
    <div id="verabschiedung">
        <h2>Wir freuen uns auf Ihren Besuch!</h2>
    </div>
@endsection

@section('copyright')
    <div id="copyright">
        &copy; E-Mensa GmbH
    </div>
@endsection

@section('footer')
    <div id="autor" class="footer_innen_abstaende">
        Hamdy Sarhan, Lukas Gonnermann
    </div>
    <div id="impressum" class="footer_innen_abstaende">
        <a href="/">Impressum</a>
    </div>
@endsection
