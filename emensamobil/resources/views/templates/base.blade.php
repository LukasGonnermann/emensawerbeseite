<!DOCTYPE html>
<html lang="@yield('lang')">
<head>
    <title>@yield('page_title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css') }}"/>
</head>
<body>
<header>
    @section('header')
    @show
    @section('navigation')
    @show
    @section('user')
    @show
</header>
<hr>
<main>
    <div>
        <br>
        <br>
        @section('sidebar')
        @show
    </div>
    <div>
        @section('main')
        @show
    </div>

</main>
<hr>
<footer>
    @section('copyright')
    @show
    @section('footer')
    @show
</footer>
</body>
</html>
