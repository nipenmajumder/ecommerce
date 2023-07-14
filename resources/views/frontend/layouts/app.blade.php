<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ env('APP_NAME')}}</title>
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @routes
    @routes('api')
    @include('frontend.layouts.css')
    @vite([ 'resources/js/app.js'])
    @stack('css')
    <style>
        .cart-icon {
            position: fixed;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            background-color: red;
            color: white;
            width: 80px;
            height: 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cart-icon i {
            margin-bottom: 5px;
            font-size: 25px;
        }

        .cart-price {
            font-weight: 400;
        }
    </style>
</head>
<body>
<div class="cart-icon">
    <i class="fas fa-shopping-cart"></i>
    <span class="cart-price">$150</span>
</div>

@include('frontend.layouts.navbar')
<main class="container">
    <x-loader></x-loader>
    @yield('content')
</main>
@include('frontend.layouts.footer')
@include('frontend.layouts.js')
@stack('js')
</body>
</html>
