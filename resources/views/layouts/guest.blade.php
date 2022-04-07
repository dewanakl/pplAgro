<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="paste-it">
    <meta name="description" content="simple paste-it">
    <meta name="keywords" content="easy to use paste-it">
    <meta name="robots" content="index, follow, noodp">
    <meta name="language" content="English">
    <meta name="google" content="notranslate">
    <meta name="author" content="dkl">
    <meta name="og:title" property="og:title" content="paste-it">
    <meta name="og:description" property="og:description" content="paste-it simple paste">
    <meta name="og:type" property="og:type" content="website">
    <meta name="og:url" property="og:url" content="{{ env('APP_URL') }}">
    <title>{{ $title }}</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body {
            overflow: overlay;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #eee;
        }

        ::-webkit-scrollbar-thumb {
            background: #2C3A47;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
    @yield('styles')
</head>

<body>
    {{ $slot }}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    @yield('scripts')
</body>

</html>