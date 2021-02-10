  <!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="theme-color" content="#29295e">
		<title>@lang('index.app-name') - @yield('title')</title>
		<meta name="description" content="&#128218; @yield('description')">
		<link rel="icon" href="{{ asset('favicon.ico') }}"  sizes="32x32">
		<link rel="icon" href="{{ asset('images/favicon-128.png') }}"  sizes="128x128">
		<link rel="icon" href="{{ asset('images/favicon-152.png') }}"  sizes="152x152">
		<link rel="icon" href="{{ asset('images/favicon-167.png') }}"  sizes="167x167">
		<link rel="icon" href="{{ asset('images/favicon-180.png') }}"  sizes="180x180">
		<link rel="icon" href="{{ asset('images/favicon-192.png') }}"  sizes="192x192">
		<link rel="icon" href="{{ asset('images/favicon-196.png') }}"  sizes="196x196">
        <link href="{{ asset('css/index.css') }}" rel="stylesheet">
        <link href="{{ asset('css/login-modal.css') }}" rel="stylesheet">
    </head>