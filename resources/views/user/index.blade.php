<?php

$js_file = 'user';
$css_file = 'user';

?>

@extends('index.index')

@section('title')
	@lang('user.title')
@endsection

@section('description')
	@lang('user.description')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>
	
<h1>@lang('user.title-h1')</h1>
<hr>
<h2>Hello {{ Auth::user()->name }}!</h2>

@endsection

