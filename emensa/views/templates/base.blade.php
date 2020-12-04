<!DOCTYPE html>
<html lang="@yield('lang')">
<head>
    <title>@yield('page_title')</title>
    <link rel="stylesheet" type="text/css" href="css/base_style.css"/>
</head>
<body>
<header>
    @section('header')
    @show
    @section('navigation')
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
