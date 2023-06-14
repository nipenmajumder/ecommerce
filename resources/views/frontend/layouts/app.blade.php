<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ env('APP_NAME')}}</title>
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @routes
    @include('frontend.layouts.css')
    @vite([ 'resources/js/app.js'])
    @stack('css')
</head>
<body>
@include('frontend.layouts.navbar')
<main class="container">
    @yield('content')
</main>
@include('frontend.layouts.footer')
@include('frontend.layouts.js')
@stack('js')
</body>
</html>
