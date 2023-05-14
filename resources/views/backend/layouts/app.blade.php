<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>@yield('title') | {{ env('APP_NAME')}}</title>
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('backend.layouts.css')
    @stack('css')
    <style>
        #layouts {
            position: fixed;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 9999;
            background-color: rgb(0 0 0 / 17%);
        }
    </style>
</head>

<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('backend.layouts.sidebar')
        <div class="layout-page">
            @include('backend.layouts.navbar')
            <div class="content-wrapper">
                <x-loader></x-loader>
                @yield('content')
                <div id="layouts" style="display: none"></div>
                @include('backend.layouts.footer')
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
@include('backend.layouts.js')
@stack('js')
</body>
</html>
