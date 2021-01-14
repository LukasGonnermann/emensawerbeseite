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
    <a href="{{ url('/') }}">◄ Zurück zur Hauptseite</a>
@endsection

@section('user')
    <a href="{{ url('/abmeldung') }}">Abmelden</a>
@endsection

@section('main')
    <table>
        <tr>
            <th>ID der Bewertung</th>
            <th>Bemerkung</th>
            <th>Zeitpunkt</th>
            <th>Sterne</th>
            <th></th>
        </tr>
        @foreach($bewertungen as $key => $bewertung)
            <tr>
                <td>{{ $bewertung->bewertung_id }}</td>
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
            </tr>
        @endforeach
    </table>
@endsection
