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
		<div id="form_contact">
			<h2>LOCATIONS</h2>
			<hr class="blue-light">

			<form name="form_profile" id="form_profile"  onsubmit="return validate_form()" novalidate>
				<div class="form">	
					<div class="row-data">
						<div class="label"><label for="name">Address:</label></div>
						<div class="star">*</div>
						<div class="input"><input id="title" type="text" name="title" maxlength="100" placeholder="Title your profile"
							value="{{ (!empty($tutor[0]->title) ? $tutor[0]->title : '') }}"
						></div>
					</div>
					<div class="hide" id="hide_title"><div role="alert" id="error_title"></div></div>
					
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
			

(40.45363770000001, -79.9469879)

    <div id="floating-panel">
      <input id="latlng" type="text" value="51.64036400000001,-0.1291008" />
      <input id="submit" type="button" value="Reverse Geocode" />
    </div>
    <div id="map"></div>
	
	    <div id="floating-panel">
      <input id="address" type="textbox" value="Sydney, NSW" />
      <input id="submit" type="button" value="Geocode" />
    </div>

	
		</div>
	</div>
	
</div>

@endsection























