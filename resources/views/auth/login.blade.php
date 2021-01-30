<?php

$js_file = 'login';
$css_file = 'login';

?>

@extends('index.index')

@section('title')
	@lang('auth.title-login')
@endsection

@section('description')
	@lang('auth.description-login')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>
	
<h1>@lang('auth.title-h1-login')</h1>
<hr>

@if (session('restricted_user'))
	<div class="message-error">
		<div>We are really sorry but you have been banned.</div>
	</div>
@endif

@if (session('not_verified'))
	<div class="message-warning">
		<div>
			You registered but haven't verified you e-mail address yet.
			<br>Please check your mail box and follow the instruction. 
			<br>If you don't find our mail, please check your spam folder.
			<br>If you have still problem with e-mail verification, please contact us.
		</div>
	</div>
@endif

@if (session('email_already_verified'))
	<div class="message-warning">
		<div>
			You have already verified your e-mail address.
			<br>Now you can login with your e-mail and password to create your tutor profile.
		</div>
	</div>
@endif

@if (session('email_verified'))
	<div class="message-success">
		<div>
			Congratulation! You verified you e-mail address successfully.
			<br>Now you can login with your e-mail and password to create your tutor profile.
		</div>
	</div>
@endif

@if (session('email_not_verified'))
	<div class="message-error">
		<div>
			We are very sorry about your e-mail address confirmation failed.
			<br>Please contact us to solve this problem.
		</div>
	</div>
@endif
@if($errors->any())
	<div class="message-error rounded" role="alert">
		{!! implode('', $errors->all('<div class="error">:message</div>')) !!}
	</div>
@endif

<div class="login">
	@include('auth/login_modal')
</div>

@endsection