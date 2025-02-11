<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{appName().' - '.config('app.description')}}</title>

    {!! style(mix('css/main.css')) !!}
    {!! style(mix('css/frontend.css')) !!}
</head>

<body class="@yield('css_class')"></body>
    @include('partials.nav-header')

    @yield('content')

    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/frontend.js')) !!}
</body>

</html>
