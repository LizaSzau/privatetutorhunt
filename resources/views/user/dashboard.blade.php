<?php

$js_file = 'dashboard';
$css_file = 'dashboard';

?>

@extends('index.index')

@section('title-dashboard')
	@lang('user.title')
@endsection

@section('description')
	@lang('user.description-dashboard')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>
	
<h1>Hello {{ Auth::user()->name }}!</h1>
<hr>
<div class="frame-dashboard">
	<h2>YOUR PROFILE</h2>
	<hr class="blue-light">

	@if  (Auth::user()->tutor->ready_flag == 0)
		<div class="message-warning-dark">
			<div>You have not created your profile yet.</div>
		</div>
		<a href="{{ url('tutor/profile/welcome') }}" class="link-main">Click here to create your tutor profile.</a>
	@endif
	
	<hr class="blue-light logout">
	<div class="logout">
		<form id="logout-form" action="{{ url('logout') }}" method="POST">
			{{ csrf_field() }}
			<button type="submit">Logout</button>
		</form>
	</div>
</div>

@endsection

