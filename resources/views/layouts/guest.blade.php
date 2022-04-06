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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            overflow: overlay;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #fff;
        }

        ::-webkit-scrollbar-thumb {
            background: rgb(117, 173, 136);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgb(32, 73, 39);
        }
    </style>
    @yield('styles')
</head>

<body>
    {{ $slot }}
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    @yield('scripts')
</body>

</html>