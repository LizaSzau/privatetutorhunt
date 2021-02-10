<?php

$js_file = 'register';
$css_file = 'register';

?>

@extends('index.index')

@section('title')
	@lang('auth.title-register')
@endsection

@section('description')
	@lang('auth.description-register')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>
	
<h1>@lang('auth.title-h1-register')</h1>
<hr>
<h2>FOR TUTORS AND TEACHERS</h2>
If you are a tutor or teacher please register or log in with one of your social media account.
<h2>FOR STUDENTS</h2>
If you are a student looking for a tutor or teacher, you don't need to register.
<div class="space-30"></div>
<hr class="reg">

<h2>REGISTRATION FORM</h2>
<div class="space-30"></div>

<form method="POST" action="{{ route('register') }}" name="form_register" onsubmit="return validate_form()" novalidate>
	@csrf 
	
	<div class="register-frame">	
		<div class="row-data">
			<div class="label"><label for="name">Name:</label></div>
			<div class="input"><input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your name" maxlength="191"></div>
		</div>
		<div class="hide" id="hide_name"><div role="alert" id="error_name"></div></div>
		
		@error('name')
		<div class="message-error">
			<div role="alert">{{ $message }}</div> 
		</div>
		@enderror
		
		<div class="row-data">
			<div class="label"><label for="email">E-mail:</label></div>
			<div class="input"><input id="email_reg" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Your e-mail" maxlength="191"></div>
		</div>
		<div class="hide" id="hide_email"><div role="alert" id="error_email"></div></div>
		
		<div id="email_laravel">
		@error('email')
		<div class="message-error">
			 <div role="alert">{{ $message }}</div> 
		</div>
		@enderror
		</div>
		
		<div class="row-data">
			<div class="label"><label for="password">Password:</label></div>
			<div class="input"><input id="password_reg" type="password" class="@error('password') is-invalid @enderror" name="password" autocomplete="new-password" autofocus placeholder="Password" maxlength="191"></div>
		</div>
		<div class="hide" id="hide_password"><div role="alert" id="error_password"></div></div>
		
		@error('password')
		<div class="message-error">
			 <div role="alert">{{ $message }}</div> 
		</div>
		@enderror
		
		<div class="row-data">
			<div class="label"><label for="password-confirm">Confirm password:</label></div>
			<div class="input"><input id="password_reg_confirm" type="password" name="password_confirmation" autocomplete="new-password" autofocus placeholder="Password" maxlength="191"></div>
		</div>
		<div class="hide" id="hide_password_confirm"><div role="alert" id="error_password_confirm"></div></div>
		
		<div class="row-data">
			<div class="label"></div>
			<div class="input"><button id="button_submit" type="submit">Register</button></div>
		</div>

		{!! RecaptchaV3::initJs() !!}
		{!! RecaptchaV3::field('register') !!}
		
		@error('g-recaptcha-response')
		<div class="message-error">
			 <div role="alert">ReCaptcha validation failed. Please try it again.</div> 
		</div>
		@enderror	
		
	</div>
</form>


   

						
						
@endsection
