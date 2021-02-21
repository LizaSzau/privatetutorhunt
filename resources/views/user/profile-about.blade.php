<?php

$js_file = 'profile-about';
$css_file = 'profile';

?>

@extends('index.index')

@section('title')
	@lang('user.title-profile-about')
@endsection

@section('description')
	@lang('user.description-profile-about')
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
		<div id="form_about" class="form-about">
			<h2 id="top_form">ABOUT YOU</h2>
			<hr class="blue-light margin-40">

			<form name="form_profile" id="form_profile"  onsubmit="return validate_form()" novalidate>
				<div class="form">	
					<div class="row-data">
						<div class="label"><label for="name">Title:</label></div>
						<div class="star">*</div>
						<div class="input"><input id="title" type="text" name="title" maxlength="100" placeholder="Title your profile"
							value="{{ (!empty($tutor[0]->title) ? $tutor[0]->title : '') }}">
						</div>
					</div>
					<div class="hide" id="hide_title"><div role="alert" id="error_title"></div></div>
					
					<div class="row-data">
						<div class="label"><label for="about_you">About you:</label></div>
						<div class="star">*</div>
						<div class="input">
							<textarea id="about" type="text" name="about" maxlength="2000" rows="10" placeholder="About you, your teaching style...">{{ (!empty($tutor[0]->about_you) ? $tutor[0]->about_you : '') }}</textarea>
						</div>
					</div>
					<div class="hide" id="hide_about"><div role="alert" id="error_about"></div></div>
					
					<div class="row-data">
						<div class="label"><label for="c_name">Experience:</label></div>
						<div class="star">*</div>
						<div class="input">
							<textarea id="experience" type="text" name="experience" maxlength="2000" rows="10" placeholder="Your teaching experience.">{{ (!empty($tutor[0]->about_experience) ? $tutor[0]->about_experience : '') }}</textarea>
						</div>
					</div>
					<div class="hide" id="hide_experience"><div role="alert" id="error_experience"></div></div>
					
					<div class="row-data">
						<div class="label"><label for="c_name">Education:</label></div>
						<div class="star">*</div>
						<div class="input">
							<textarea id="education" type="text" name="education" maxlength="2000" rows="10" placeholder="Your qualifications and studies.">{{ (!empty($tutor[0]->about_education) ? $tutor[0]->about_education : '') }}</textarea>
						</div>
					</div>
					<div class="hide" id="hide_education"><div role="alert" id="error_education"></div></div>
					
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