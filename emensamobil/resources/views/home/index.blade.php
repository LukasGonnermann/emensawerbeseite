@extends('templates.base')

@section('page_title')
    {{ $title }}
@endsection

@section('css_path')
    {{ "css/base_style.css" }}
@endsection

@section('header')
    <div id="logo">
        <div><a href="{{ url('/') }}">E-Mensa Logo</a></div>
    </div>
@endsection

@section('navigation')
    <div id="adressen">
        <a href="#ankuendigungen">Ankündigungen</a>
        <a href="#speisen">Speisen</a>
        <a href="/">Zahlen</a>
        <a href="#diuw">Wichtig für uns</a>
        <a href="#impressum">Kontakt</a>
    </div>
@endsection
@section('user')
    <div id="user">
        @if(session()->get('login_ok'))
            Angemeldet als: <a href="{{ '/profil' }}">{{ Session::get('name') }}</a>
            <a href="{{ url('/abmeldung') }}">Abmelden</a>
        @else
            <a href="{{ url('/anmeldung') }}">Anmelden</a>
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

    <!-- Gerichte -->
    <div>
        <h2 id="speisen">Köstlichkeiten, die Sie erwarten:</h2>
        <table id="speisen_table" class="center">
            <tr>
                <th>Name</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
                <th>Allergene</th>
                <th>Bild</th>
            </tr>
            @foreach($gerichte as $key => $gericht)
                <tr>
                    <td>{{ $gericht->name}}</td>
                    <td>{{ number_format($gericht->preis_intern, 2) . "€" }}</td>
                    <td>{{ number_format($gericht->preis_extern, 2) . "€" }}</td>

                    <td>
                        @if($allergene[$key])
                            @foreach($allergene[$key] as $value)
                                {{ $value }}
                            @endforeach
                        @else
                            {{ "Keine Allergene" }}
                        @endif

                    </td>
                    <td><img src="http://localhost:9005/img/gerichte/{{$gericht->bildname}}" width="70" height="70" alt="{{ $gericht->name }}"></td>
                    @if(session()->get('login_ok'))
                        <td><a href="{{ url("/bewertung?gerichtid=$gericht->id") }}">Bewerten</a></td>
                    @endif

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

    @if($bewertungen != null)
    <!-- User Bewertungen -->
    <div id="bewertungen_index">
        <h2>Das sagen unsere Nutzer</h2>
        <table id="user_bewertungen" class="center">
            <tr>
                <th>Name des Gerichts</th>
                <th>Bemerkung</th>
                <th>Sterne</th>
            </tr>
            @foreach($bewertungen as $key => $bewertung)
                <tr>
                    <td>{{ $bewertung->name }}</td>
                    <td>{{ $bewertung->bemerkung }}</td>
                    <td>
                        @switch($bewertung->sterne_bewertung)
                            @case('1')
                            ☆☆☆☆
                            @break
                            @case('2')
                            ☆☆☆
                            @break
                            @case('3')
                            ☆☆
                            @break
                            @case('4')
                            ☆
                            @break
                        @endswitch</td>

                </tr>
            @endforeach
        </table>
    </div>
    @endif
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
