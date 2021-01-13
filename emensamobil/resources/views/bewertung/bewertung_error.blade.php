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
    <div id="error_msg">
        <h1>Ungültiges Formular</h1>
        <a href="{{ url('/') }}">Zurück zur Hauptseite</a>
    </div>
@endsection
