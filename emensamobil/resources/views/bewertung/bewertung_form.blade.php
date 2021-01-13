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
        <fieldset id="bewertung">
            <legend>Gericht Bewerten</legend>
            <label for="sterneDrop">Bewertung:</label>
            <select name="sterne" id="sterneDrop">
                <option value="1">Sehr gut!</option>
                <option value="2">Gut</option>
                <option value="3">Schlecht</option>
                <option value="4">Sehr Schlecht!</option>
            </select><br>
            <label for="bemerkungArea">Bemerkung:</label>
            <textarea id="bemerkungArea" name="bemerkung" rows="6" cols="50"
                      placeholder="Hier eine kleine Bemerkung zu der Bewertung verfassen!"></textarea><br>
            <input id="bewertung_submit" type="submit" value="Abschicken!" name="submit">
        </fieldset>
    </form>
@endsection
