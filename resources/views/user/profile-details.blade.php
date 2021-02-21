<?php

$js_file = 'profile-details';
$css_file = 'profile';

?>

@extends('index.index')

@section('title')
	@lang('user.title-profile-details')
@endsection

@section('description')
	@lang('user.description-profile-details')
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
		<div id="form_details" class="form-details">
			<h2 id="top_form">Details</h2>
			<hr class="blue-light">
			<div class="content">
				<div class="info rounded">
					The fee is indicative, an average hourly rate.
				</div>
			</div>
			
			<form name="form_profile" id="form_profile"  onsubmit="return validate_form()" novalidate>
				<div class="form">	
					<div class="row-data checkbox chb-title">
						<div class="label">Where:</div>
						<div class="star">*</div>
						<div class="input">
							<div><input type="checkbox" id="where_online" value="1" name="where_online" @if ($tutor[0]->where_online == 1) checked="checked" @endif></div>
							<div><label for="where_online">Online</label></div>
						</div>
					</div>
					<div class="row-data checkbox">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input">
							<div><input type="checkbox" id="where_tutor_place" value="1" name="where_tutor_place" @if ($tutor[0]->where_tutor_place == 1) checked="checked" @endif></div>
							<div><label for="where_tutor_place">My place (in person)</label></div>
						</div>
					</div>
					<div class="row-data checkbox">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input">
							<div><input type="checkbox" id="where_student_place" value="1" name="where_student_place" @if ($tutor[0]->where_student_place == 1) checked="checked" @endif></div>
							<div><label for="where_student_place">Student's place (in person)</label></div>
						</div>
					</div>
					<div class="hide" id="hide_where"><div role="alert" id="error_where"></div></div>
					
					<div class="row-data checkbox chb-title">
						<div class="label">When:</div>
						<div class="star">*</div>
						<div class="input">
							<div><input type="checkbox" id="when_morning" value="1" name="when_morning" @if ($tutor[0]->when_morning == 1) checked="checked" @endif></div>
							<div><label for="when_morning">Morning</label></div>
						</div>
					</div>
					<div class="row-data checkbox">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input">
							<div><input type="checkbox" id="when_afternoon" value="1" name="when_afternoon" @if ($tutor[0]->when_afternoon == 1) checked="checked" @endif></div>
							<div><label for="when_afternoon">Afternoon</label></div>
						</div>
					</div>
					<div class="row-data checkbox">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input">
							<div><input type="checkbox" id="when_evening" value="1" name="when_evening" @if ($tutor[0]->when_evening == 1) checked="checked" @endif></div>
							<div><label for="when_evening">Evening</label></div>
						</div>
					</div>
					<div class="row-data checkbox">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input">
							<div><input type="checkbox" id="when_weekend" value="1" name="when_weekend" @if ($tutor[0]->when_weekend == 1) checked="checked" @endif></div>
							<div><label for="when_weekend">Weekend</label></div>
						</div>
					</div>
					<div class="hide" id="hide_when"><div role="alert" id="error_when"></div></div>
					
					<div class="row-data">
						<div class="label"><label for="fee">Fee:</label></div>
						<div class="star">*</div>
						<div class="input short">
							<div>
								<input id="fee" type="text" name="fee" onkeypress="return isNumberKey(event)" maxlength="4" pattern="[0-9]" 
									value="{{ (!empty($tutor[0]->fee) ? $tutor[0]->fee : '') }}"
								> 
							</div>
							<div>&pound / hour</div>
						</div>
					</div>
					<div class="hide" id="hide_fee"><div role="alert" id="error_fee"></div></div>
					
					<div class="row-data">
						<div class="label"><label for="comment">Comment:</label></div>
						<div class="star"></div>
						<div class="input">
							<textarea id="comment" type="text" name="comment" maxlength="1000" rows="10" placeholder="Information related to the teaching conditions.">{{ (!empty($tutor[0]->comment) ? $tutor[0]->comment : '') }}</textarea>
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
								<a href="{{ url('/tutor/profile/activate') }}">
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