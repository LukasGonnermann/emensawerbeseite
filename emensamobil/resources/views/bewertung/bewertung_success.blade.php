@extends('templates.base')
@section('page_title')
    Gerichtebewertung
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
    <h1>Ihre Bewertung wurde gespeichert!</h1>
    <a href="{{ url('/meinebewertungen') }}">Zu allen meinen Bewertungen</a><br>
    <a href="{{ url('/') }}"> Zurück zur Hauptseite</a>
@endsection
