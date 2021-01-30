<?php

$js_file = 'register';
$css_file = 'register';

?>

@extends('index.index')

@section('title')
	@lang('auth.title-successfully-registered')
@endsection

@section('description')
	@lang('auth.description-successfully-registered')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>

@if (session('status'))
	
<h1>@lang('auth.title-h1-successfully-registered')</h1>
<hr>

<h2>YOUR REGISTRATION HAS BEEN SUCCESSFUL!</h2>
<div class="space-30"></div>

<div class="message-success">
	<div>
		We sent you a letter to confirm your e-mail address<br>Please, check your mail box and click the link in the letter.
	</div>
</div>

<p><br>If you do not receive the letter in half an hour please contact us.

@else
	<script>window.location = '/';</script>
@endif
	
@endsection
