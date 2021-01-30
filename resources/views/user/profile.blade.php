<?php

$js_file = 'profile';
$css_file = 'profile';

?>

@extends('index.index')

@section('title')
	@lang('user.title-profile')
@endsection

@section('description')
	@lang('user.description-profile')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>
	
<h1>Your tutor profile</h1>
<hr>

<div class="frame-tutor">
	<div class="frame-tutor-status">
		<div class="status-main">
			<div class="status-item">
				<div>Contact</div>
				<div><img src="{{ asset('images/fa-tick.png') }}"></div>
			</div>
			<div class="status-item">
				<div>About you</div>
				<div><img src="{{ asset('images/fa-tick.png') }}"></div>
			</div>
			<div class="status-item">
				<div>Media</div>
				<div><img src="{{ asset('images/fa-tick.png') }}"></div>
			</div>
			<div class="status-item">
				<div>Subjects</div>
				<div><img src="{{ asset('images/fa-tick.png') }}"></div>
			</div>
			<div class="status-item">
				<div>Locations</div>
				<div><img src="{{ asset('images/fa-tick.png') }}"></div>
			</div>
			<div class="status-item">
				<div>Details</div>
				<div><img src="{{ asset('images/fa-tick.png') }}"></div>
			</div>
			<div class="status-item">
				<div>Active</div>
				<div><img src="{{ asset('images/fa-tick.png') }}"></div>
			</div>
		</div>
	</div>  
	<div class="frame-tutor-form">
		<div id="form_contact">@include('user/form-contact')</div>
	</div>
</div>

@endsection

