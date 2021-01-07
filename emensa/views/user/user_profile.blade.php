@extends('templates.base')
@section('page_title')
    EMensa Profil
@endsection

@section('css_path')
    {{ "css/base_style.css" }}
@endsection

@section('header')
    <div id="logo">
        <div><a href="/">E-Mensa Logo</a></div>
    </div>
@endsection

@section('navigation')
<a href="/">◄ Zurück zur Hauptseite</a>
@endsection

@section('user')
    <a href="/abmeldung">Abmelden</a>
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