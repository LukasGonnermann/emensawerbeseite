@extends('templates.base')
@section('page_title')
    Bewertungen
@endsection

@section('css_path')
    {{ "css/base_style.css" }}
@endsection

@section('header')
    <div id="logo">
        <div><a href="{{ url('/') }}">E-Mensa Logo</a></div>
    </div>
@endsection

@section('main')
    <table>
        <tr>
            <th>ID der Bewertung</th>
            <th>Bemerkung</th>
            <th>Zeitpunkt</th>
            <th>Sterne</th>
            <th>Hervorhebung</th>
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
                    @endswitch</td>
                @if(session()->get('login_ok'))
                    <td><a href="{{  url("/hervorheben?bewertung_id=$bewertung->bewertung_id") }}">Hervorheben</a></td>
                    @endif
            </tr>
        @endforeach
    </table>
@endsection
