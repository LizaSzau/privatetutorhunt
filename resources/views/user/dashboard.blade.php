<?php

$js_file = 'dashboard';
$css_file = 'dashboard';

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
	
<h1>Hello {{ Auth::user()->name }}!</h1>
<hr>
<div class="frame-dashboard">
	<h2>YOUR PROFILE</h2>
	<hr class="blue-light">

	@if  (Auth::user()->tutor->tutorReady->flag_ready == 0)
		<div class="message-warning-dark">
			<div>You have not created your profile yet.</div>
		</div>
		<a href="{{ url('tutor/profile/welcome') }}" class="link-main">Click here to create your tutor profile.</a>
	@else
		@if  (Auth::user()->tutor->flag_status == 0  )
			<div class="message-warning-dark">
				<div>Your profile is ready but inactive and invisible for the students.</div>
			</div>
			<a href="{{ url('tutor/profile/activate') }}" class="link-main">Click here to activate your profile.</a>
		@endif
		
		@if  (Auth::user()->tutor->flag_status == 1  )
			<div class="message-success-dark">
				<div>Your profile is active.</div>
			</div>
			<a href="{{ url('tutor/id/'.Auth::user()->tutor->id) }}" class="link-main">You can see your profile here.</a>
		@endif
		
		@if  (Auth::user()->tutor->flag_status == 2  )
			<div class="message-error-dark">
				<div>Your profile is inactive and invisible for the students.</div>
			</div>
			<a href="{{ url('tutor/profile/activate') }}" class="link-main">Click here to activate your profile.</a>
		@endif
	@endif
	<div class="button-div">
		<a href="profile/welcome"><button type="submit">Edit your profile</button></a>
	</div>
	<hr class="blue-light">
	<div class="button-div">
		<form id="logout-form" action="{{ url('logout') }}" method="POST">
			{{ csrf_field() }}
			<button type="submit">Logout</button>
		</form>
	</div>
</div>

@endsection

