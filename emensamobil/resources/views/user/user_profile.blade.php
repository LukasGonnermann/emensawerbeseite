@extends('templates.base')
@section('page_title')
    EMensa Profil
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
    <a href="{{ url('/') }}">◄ Zurück zur Hauptseite</a>
@endsection

@section('user')
    <a href="{{ url('/abmeldung') }}">Abmelden</a>
@endsection

@section('sidebar')
    <a href="{{ '/meinebewertungen' }}">Meine Bewertungen</a>
@endsection

@section('main')
<div id="profil_container">
    <h2>EMensa Profil</h2>
    <p></p>
    <div>Email:</div>
    <div>{{ $email }}</div>
    <div>Anzahl der Anmeldungen:</div>
    <div>{{ $anzahlanmeldungen }}</div>
    <div>Admin:</div>
    <div>@if($admin == 1)
            Ja
        @else
            Nein
        @endif</div>
</div>
@endsection
