@extends('templates.base')
@section('page_title')
Meine Bewertungen
@endsection
@section('header')
    <div id="logo">
        <div><a href="{{ url('/') }}">E-Mensa Logo</a></div>
    </div>
@endsection

@section('navigation')
    <a href="{{ url('/profil') }}">◄ Zurück zum Profil</a>
@endsection

@section('user')
    <a href="{{ url('/abmeldung') }}">Abmelden</a>
@endsection

@section('main')
    @if($bewertungen != null)
    <table>
        <tr>
            <th>Name des Gerichts</th>
            <th>Bemerkung</th>
            <th>Zeitpunkt</th>
            <th>Sterne</th>
            <th></th>
        </tr>

        @foreach($bewertungen as $key => $bewertung)
            <tr>
                <td>{{ $bewertung->name }}</td>
                <td>{{ $bewertung->bemerkung }}</td>
                <td>{{ $bewertung->zeitpunkt }}</td>
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
                @endswitch
                </td>
                <td>
                    <a href="{{ url("/bewertung_loeschen?bewertung_id=$bewertung->bewertung_id") }}">Löschen</a>
                </td>
            </tr>
        @endforeach
    </table>
    @else
        <h3 id="keine_bewertungen">Keine Bewertungen vorhanden!</h3>
    @endif
@endsection
