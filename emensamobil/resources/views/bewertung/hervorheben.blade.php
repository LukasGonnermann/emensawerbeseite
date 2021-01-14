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
    <h>Hervorgehoben!</h>
@endsection

@section('navigation')
    <a href="{{ url('/') }}">◄ Zurück zur Hauptseite</a>
@endsection
