@extends('templates.base')
@section('page_title')
    {{ $title }}
@endsection

@section('header')
    <div id="logo">
    <div>E-Mensa Logo</div>
    </div>
@endsection

@section('navigation')
    <div id="adressen" >
        <a href="/">Ankündigungen</a>
        <a href="#speisen">Speisen</a>
        <a href="/">Zahlen</a>
        <a href="/">Wichtig für uns</a>
        <a href="/">Kontakt</a>
    </div>
@endsection

@section('main')
    <div id="placeholder">
        <h1>Wilkommen auf der E-Mensa Webseite</h1>
    </div>
    {{ print("<pre>".print_r($gerichte,true)."</pre>") }}
    <div>
        <h2 id="speisen">Köstlichkeiten, die Sie erwarten:</h2>
        <table class="center">
            <tr>
                <th>Name</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
                <th>Allergene</th>
            </tr>
            @foreach($gerichte as $gericht)
                <tr>
                    <td>{{ $gericht[0]}}</td>
                    <td>{{ number_format($gericht[1], 2) . "€" }}</td>
                    <td>{{ number_format($gericht[2], 2) . "€" }}</td>
                    <td></td>
                </tr>
            @endforeach
        </table>
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
