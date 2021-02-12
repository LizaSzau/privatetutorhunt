<?php

$js_file = 'profile-subjects';
$css_file = 'profile';

?>

@extends('index.index')

@section('title')
	@lang('user.title-profile-subjects')
@endsection

@section('description')
	@lang('user.description-profile-subjects')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>
	
<h1>Your tutor profile</h1>
<hr>

<input type="hidden" id="subject_number" value="{{ $subject_number }}">
				
<div class="frame-tutor">
	@include('user/profile-menu')  
	<div class="frame-tutor-form">
		<div id="form_subjects" class="form-subjects">
			<h2>SUBJECTS</h2>
			<hr class="blue-light">

			<div class="content">
				<div class="info rounded">
					<ul>
						<li>Please upload at least one subject.</li>
					</ul>
				</div>
			</div>
			
			<form name="form_profile" id="form_profile"  onsubmit="return validate_form()" novalidate>
				<div class="form">	
				
					<div class="row-data">
						<div class="label"><label for="select_subject">Subjects:</label></div>
						<div class="star"></div>
						<div class="select input">
							<img src="{{ asset('images/fa-down.png') }}" alt="Select subject">
							<select name="select_subject" id="select_subject">
								<option value="0">Select subject</option>
				
								@foreach($categories as $category)
										<option class="category-name" disabled>{{ $category->name }}</option>
									@foreach($category->subjects as $subject)
										<option class="option" value="{{ $subject->id }}">{{ $subject->name }}</option>
									@endforeach
								@endforeach
								
							</select>
						</div>
					</div>
	
					<div class="row-data">
						<div class="label"><label for="select_level">Level:</label></div>
						<div class="star"></div>
						<div class="select input">
							<img src="{{ asset('images/fa-down.png') }}" alt="Select subject">
							<select name="select_level" id="select_level">
								<option value="0">Select level</option>
							
								@foreach($levels as $level)
									<option class="option" value="{{ $level->id }}">{{ $level->level }}</option>
								@endforeach
								
							</select>
						</div>
					</div>
			
					<div class="row-data">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input buttons add">
							<div><button id="btn_add">Add</button></div>
						</div>
					</div>
					
					<h3>Selected subjects:</h3>
					
					<div id="tutor_subjects">	
						@foreach($subjects as $subject)
							<div id="{{ $subject->subject_id }}_{{ $subject->level_id }}">
								<button onclick="delete_item('{{ $subject->subject_id }}_{{ $subject->level_id }}')"><img src="{{ asset('images/fa-trash.png') }}" alt="delete" title="delete"></button>
								<span class="subject">{{ $subject->name }}</span> - {{ $subject->level }}
							</div>
						@endforeach
					</div>
					
					<div class="hide" id="hide_delete"><div role="alert" id="error_delete"></div></div>
				</div>
				
			</form>
			
			<div class="form">
				<div class="missing-subject rounded">
					<div class="question">
						<h3>Missing subjects</h3>
						Isn't your subject included in the list?
					</div>
					<div class="info">
						You can suggest up to 3 subjects at a time.
						<br>We will review your suggestion  within 24 hours and notify you by email.</br>
					</div>
					<div id="missing">
						<form name="form_missing" id="form_missing" onsubmit="return validate_form_missing()" novalidate>
							<input type="hidden" id="subject_missing_number" name="subject_missing_number" value="{{ count($new_subjects) }}">
							<div class="form">	
								<div class="row-data">
									<div class="label"><label for="subject">Subject:</label></div>
									<div class="star"></div>
									<div class="input">
										<input id="subject_missing" type="text" name="subject" maxlength="50" placeholder="Missing subject name">
									</div>
								</div>
								
								<div class="row-data">
									<div class="label"></div>
									<div class="star"></div>
									<div class="input buttons add">
										<div><button id="btn_add_missing">Add</button></div>
									</div>
								</div>
							</div>
						</form>
					</div>	
					<div id="suggested_subjects" class="hide">
						<div class="subjects-list">Suggested subjects:</div>
						<ul id="subjects_list">
							@foreach($new_subjects as $new_subject)
								<li>{{ $new_subject->name }}</li>
							@endforeach						
						</ul>
					</div>
				</div>
				
				<div class="row-data">
					<div class="label"></div>
					<div class="star"></div>
					<div class="input buttons subject">
						<div>
							<a href="{{ url('/tutor/profile/location') }}">
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



















