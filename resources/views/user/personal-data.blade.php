<?php

$js_file = 'personal-data';
$css_file = 'personal-data';

?>

@extends('index.index')

@section('title-dashboard')
	@lang('user.title-dashboard')
@endsection

@section('description')
	@lang('user.description-dashboard')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>
	
<h1>Personal data</h1>
<hr>
<div class="frame-dashboard">
	<h2>DELETE YOUR ACCOUNT</h2>
	<hr class="blue-light">

	<div class="message-error-dark">
		<div class="cont">
			Deleting your data will permanently remove all of your data from the server including registration data and tutor profile.<br>
			Instead of deleting your data you can inactivate your profile and come back when you would like.
		</div>
	</div>
	<a href="{{ url('tutor/profile/activate') }}" class="link-main">I prefer to deactivate my profile.</a>

	<form method="POST" action="personal-data/delete" autocomplete="off" name="form_delete" id="form_delete" onsubmit="return validate_form_delete()" novalidate>
		 @csrf
		<div class="form rounded">
			<div>Write in the textfield: <code>delete all of my data</code></div>
			<div><input id="delete" type="text" name="delete"></div>
			<div><button id="btn_form">Delete account</button></div>
		</div>
	</form>
</div>

@endsection

