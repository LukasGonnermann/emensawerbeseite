@extends('templates.base')
@section('page_title')
{{ $title }}
@endsection

@section('css_path')
    {{ "css/base_style.css" }}
@endsection

@section('header')
    <div id="logo">
        <div>E-Mensa Logo</div>
    </div>
@endsection

@section('navigation')

@endsection

@section('main')
    <!-- Anmeldung Form -->
    <Form method="post" action="{{ url('/anmeldung_verifizieren') }}">
        @csrf
        <fieldset id="anmeldung">
            <legend>
                Anmeldung
            </legend>
            @if ($msg != null)
                <p style="color:red;">{{ $msg }}</p>
            @endif
            <label for="emailField">E-Mail Adresse:</label>
            <input id="emailField" type="email" name="email"><br>
            <label for="passwordField">Passwort:</label>
            <input id="passwordField" type="password" name="password"><br>
            <input id="anmeldung_submit" type="submit" value="Anmelden!" name="submit">
        </fieldset>
    </Form>
@endsection
