<?php

$js_file = 'profile-activate';
$css_file = 'profile';

?>

@extends('index.index')

@section('title')
	@lang('user.title-profile-activate')
@endsection

@section('description')
	@lang('user.description-profile-activate')
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
		<div id="form_about" class="form-activate">
			<h2 id="top_form">ACTIVATE</h2>
			<hr class="blue-light">

			@if  (Auth::user()->tutor->tutorReady->flag_ready == 0)
				<div class="message-warning-dark">
					<div>You have not created your profile yet.</div>
				</div>
				<div class="content">
					First finish your profile and then you can make it active.
					<br>Your profile is finished when every tick is green except the one next to the <code>[activate button]</code>.
				</div>
			@else
				@if  (Auth::user()->tutor->flag_status == 0  )
					<div class="message-warning-dark">
						<div>Congratulation! Your profile is ready but inactive and invisible for the students.</div>
					</div>
					<a href="activate/set"><button class="activate">Activate your profile</button></a>
				@endif
				
				@if  (Auth::user()->tutor->flag_status == 1  )
					<div class="message-success-dark">
						<div>Your profile is active.</div>
					</div>
					<a href="activate/set"><button class="activate">Deactivate your profile</button></a>
				@endif
				
				@if  (Auth::user()->tutor->flag_status == 2  )
					<div class="message-error-dark">
						<div>Your profile is inactive and invisible for the students.</div>
					</div>
					<a href="activate/set"><button class="activate">Activate your profile</button></a>
				@endif
			@endif
</label>


		</div>
	</div>
</div>

@endsection