<?php

$js_file = 'profile-locations';
$css_file = 'profile';

?>

@extends('index.index')

@section('title')
	@lang('user.title-profile-locations')
@endsection

@section('description')
	@lang('user.description-profile-location')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>
	
<h1>Your tutor profile</h1>
<hr>

<div class="frame-tutor">
	@include('user/profile-menu')  
	<div class="frame-tutor-form">
		<div id="form_location" class="location">
			<h2>LOCATION</h2>
			<hr class="blue-light">


			<div class="content">
				<div class="info rounded">
					<ul>
						<li>You do not need to enter your full address if you don't want to. City, town, borough or district is enough.</li>
						<li>The address will be visible on your profile.</li>
						<li>Don't forget to click on the <code>[check address]</code> button.</li>
					</ul>
				</div>
			</div>
			
			<form name="form_profile" id="form_profile"  onsubmit="return validate_form()" novalidate>
				<input type="hidden" name="lat" id="lat" value="{{ (!empty($tutor[0]->lat) ? $tutor[0]->lat : '0') }}">
				<input type="hidden" name="lng" id="lng" value="{{ (!empty($tutor[0]->lng) ? $tutor[0]->lng : '0') }}">
				<div class="form">	
					<div class="row-data">
						<div class="label"><label for="address">Address:</label></div>
						<div class="star">*</div>
						<div class="input"><input id="address" type="text" name="address" placeholder="Your address"
							value="{{ (!empty($tutor[0]->address) ? $tutor[0]->address : '') }}" maxlength="50">
						</div>
					</div>
					<div class="hide" id="hide_address"><div role="alert" id="error_address"></div></div>
					
					<div class="row-data row-check">
						<div class="label"></div>
						<div class="star"></div>
						<div class="div-check-address">
							<div id="btn_check_address" class="btn-warning">Check address</div>
						</div>
					</div>
					<div class="row-data row-map">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input">
							<div id="map" class="rounded"></div>
						</div>
					</div>
					
					<div class="ajax" id="ajax_profile"><img src="{{ asset('images/ajax.svg') }}"></div>
					<div class="hide" id="hide_form"><div role="alert" id="error_form"></div></div>
					
					<div class="row-data">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input buttons">
							<div><button id="btn_form">Save</button></div>
							<div>
								<a href="{{ url('/tutor/profile/media') }}">
									<div id="btn_form_next" class="btn-next rounded">Next step</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</form>
			
		</div>
	</div>
	
</div>

@endsection























