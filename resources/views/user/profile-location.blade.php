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
			<h2 id="top_form">Locations</h2>
			<hr class="blue-light">
			
			<div class="content">
				<div class="info rounded">
					<ul>
						<li>You do not need to enter your full address if you don't want to. City, town, borough or district is enough.</li>
						<li>At least one address is necessary.</li>
						<li>You can add 3 addresses to your profile.</li>
						<li>Clicking on the map icon you can check if the address is correct on the map.</li>
					</ul>
				</div>
			</div>
			
			<form name="form_profile" id="form_profile"  onsubmit="return validate_form()" novalidate>
				<input type="hidden" name="locations_number" id="locations_number" value="{{ count($locations) }}">
				<div class="form">	
					<div id="hide_max">
						<div class="row-data">
							<div class="label"><label for="address">Address:</label></div>
							<div class="star">*</div>
							<div class="input"><input id="address" type="text" name="address" placeholder="Your address"
								value="{{ (!empty($tutor[0]->address) ? $tutor[0]->address : '') }}" maxlength="50">
							</div>
						</div>
						<div class="hide" id="hide_address"><div role="alert" id="error_address"></div></div>

						<div class="row-data" id="btn_row">
							<div class="label empty"></div>
							<div class="star empty"></div>
							<div class="input buttons add">
								<div><button id="btn_form">Add</button></div>
							</div>
						</div>
						
						<div class="ajax" id="ajax_profile"><img src="{{ asset('images/ajax.svg') }}"></div>
					</div>	
				</div>
			</form>	
			<div class="form">
				@if(count($locations) > 0) 
					<h3>Your locations:</h3>
		
					<div id="tutor_locations">	
						@foreach($locations as $location)
							<div class="address-flex" id="location_{{ $location->id }}">
								<div>
									<button class="btn-delete" onclick="delete_item('{{ $location->id }}')"><img src="{{ asset('images/fa-trash.png') }}" alt="delete" title="delete"></button>
								</div>
								<div>
									<button class="btn-map" onclick="show_map('{{ $location->id }}')"><img src="{{ asset('images/fa-map.png') }}" alt="show map" title="shpw map"></button>
								</div>
								<div class="address">
									{{ $location->address }} 
									<span class="hide" id="lat_{{ $location->id }}">{{ $location->lat }}</span>
									<span class="hide" id="lng_{{ $location->id }}">{{ $location->lng }}</span>
								</div>
							</div>
							<div class="map-hide" id="map_{{ $location->id }}"></div>
						@endforeach
					</div>
					
					<div class="hide" id="hide_delete"><div role="alert" id="error_delete"></div></div>
				
				@endif
					
				<div class="row-data">
					<div class="label"></div>
					<div class="star"></div>
					<div class="input buttons add">
						<div>
							<a href="{{ url('/tutor/profile/details') }}">
								<div id="btn_form_next" class="btn-next rounded">Next step</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	
</div>

@endsection























