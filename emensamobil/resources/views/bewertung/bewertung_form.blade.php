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
<form method="post" action="{{ url('/bewertung_verifizieren') }}">
    @csrf
    <fieldset>
        <legend>Gericht Bewerten</legend>
        <label for="emailField">E-Mail Adresse:</label>
        <input id="emailField" type="email" name="email"><br>
        <label for="passwordField">Passwort:</label>
        <input id="passwordField" type="password" name="password"><br>
        <input id="anmeldung_submit" type="submit" value="Anmelden!" name="submit">
    </fieldset>
</form>
@endsection
