<?php

$js_file = 'home';
$css_file = 'home';

?>

@extends('index.index')

@section('title')
	@lang('home.title')
@endsection

@section('description')
	@lang('home.description')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>
	
<h1>Terms of service</h1>
<hr>

@endsection

