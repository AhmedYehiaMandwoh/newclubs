<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{\App\Classes\Localization::getHtmlDirection()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
{{--    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-touch-icon.png') }}">--}}
{{--    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/favicon-32x32.png') }}">--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icons/favicon-16x16.png') }}">--}}
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}?v=1.1">
{{--    <link rel="mask-icon" href="{{ asset('icons/safari-pinned-tab.svg') }}" color="#5bbad5">--}}
{{--    <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}">--}}
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="{{ asset('icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;400;500;700&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @routes
    @vite('resources/js/app.js')
    @inertiaHead
</head>
<body class="font-sans antialiased text-xl font-inhert">
@inertia
</body>
</html>
