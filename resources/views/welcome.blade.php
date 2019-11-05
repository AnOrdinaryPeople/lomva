<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        .slide-fade-enter-active, .slide-fade-leave-active{
			transition-duration: .3s;
			transition-property: height, opacity, transform;
			transition-timing-function: cubic-bezier(1.0, 0.5, 0.8, 1.0);
			overflow: hidden
		}
		.slide-fade-enter, .slide-fade-leave-active {
			opacity: 0;
			transform: translate(2em, 0)
		}
    </style>
</head>
<body>
    <div id="app"></div>
</body>
</html>
