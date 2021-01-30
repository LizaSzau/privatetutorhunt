<?php

$js_file = 'reset-password';
$css_file = 'register';

?>

@extends('index.index')

@section('title')
	@lang('auth.title-reset-password')
@endsection

@section('description')
	@lang('auth.description-reset-password')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>
	
<h1>@lang('auth.title-h1-reset-password')</h1>
<hr>

<form method="POST" action="{{ route('password.email') }}" name="form_reset_password" onsubmit="return validate_form()" novalidate>
@csrf

	<div class="register-frame">
	
		@if (session('status'))
		<div class="message-success">
			<div role="alert">{{ session('status') }}</div> 
		</div>
		@endif

		<div class="row-data">
			<div class="label"><label for="email" class="col-md-4 col-form-label text-md-right">E-mail:</label></div>
			<div class="input"><input id="email_reset" type="email" class="" name="email" value="{{ old('email') }}" autocomplete="email" autofocus></div>
		</div>
		<div class="hide" id="hide_email"><div role="alert" id="error_email"></div></div>
		
		@error('email')
		<div class="message-error">
			<div role="alert">{{ $message }}</div> 
		</div>
		@enderror

		<div class="row-data">
			<div class="label"></div>
			<div class="input"><button id="button_submit" class="btn-reset" type="submit">Send password reset link</button></div>
		</div>
	</div>
</form>
@endsection
