<!DOCTYPE html>
<html lang="@yield('lang')">
<head>
    <title>@yield('page_title')</title>
    <link rel="stylesheet" type="text/css" href="@yield('css_path')"/>
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

<main>
    @section('main')
    @show
</main>

<footer>
    @section('copyright')
    @show
    @section('footer')
    @show
</footer>
</body>
</html>
