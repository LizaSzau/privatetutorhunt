<?php

$js_file = 'profile-welcome';
$css_file = 'profile';

?>

@extends('index.index')

@section('title')
	@lang('user.title-profile-welcome')
@endsection

@section('description')
	@lang('user.description-profile-welcome')
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
			<h2 id="top_form">CREAT YOUR PROFILE</h2>
			<hr class="blue-light">
			<div class="content">
				<ul>
					<li>You can create and manage your profile here.</li>
					<li>The green check marks indicate that you have entered your tutor details sucessfully to that part of your profile.</li>
					<li>Your profile will only be visible if every check mark is green.</li>
					<li>Do not forget to make active your profile.</li>
				</ul>
				<p><br>
				<a href="contact" class="link-main">Contact</a>
				<br>You name, e-mail, phone numbers, webpage and Facebook profile.
				<p><br>
				<a href="about" class="link-main">About</a>
				<br>A short and concise summary as a title of your profile, a description of you, your studies and your experience.
				<p><br>
				<a href="media" class="link-main">Media</a>
				<br>You can uploade some photos and YouTube link to make your profile more impressive.
				<p><br>
				<a href="subjects" class="link-main">Subjects</a>
				<br>The subjects and levels you teach.
				<p><br>
				<a href="locations" class="link-main">Locations</a>
				<br>The places where you teach.
				<p><br>
				<a href="details" class="link-main">Details</a>
				<br>The details about you. Who dou you teach, when end where you are available, how much is your fee and so on.
				<p><br>
				<a href="activate" class="link-main">Activate</a>
				<br>You can active or deactive your profile.
				<p><br>
				<div>
					<a href="{{ url('/tutor/profile/contact') }}">
						<button>Let's start</button>
					</a>
				</div>
				<p><br>
			</div>
		</div>
	</div>
</div>

@endsection