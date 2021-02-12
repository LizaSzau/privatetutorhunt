<?php

$js_file = 'profile-media';
$css_file = 'profile';

?>

@extends('index.index')

@section('title')
	@lang('user.title-profile-media')
@endsection

@section('description')
	@lang('user.description-profile-media')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>
	
<h1>Your tutor profile</h1>
<hr>

<input type="hidden" id="image_number" value="{{ $image_number }}">
<input type="hidden" id="video_number" value="{{ $video_number }}">
<input type="hidden" id="path" value="{{ public_path() }}">

<div class="frame-tutor">
	@include('user/profile-menu')  
	<div class="frame-tutor-form">
		<div>
			<h2>MEDIA</h2>
			<hr class="blue-light">
			
			<div class="content">
				<h3>Images</h3>
				<div class="info rounded">
					<ul>
						<li>You can upload maximum 5 images.</li>
						<li>Accepted file type: JPG</li>
						<li>Maximum file size: 8MB</li>
						<li>Please upload at least one image.</li>
						<li>The first photo is your profile image</li>
						<li>After uploading you can order the images by drag and drop.</li>
						<li>You can delete an image by dragging out.</li>
					</ul>
				</div>
			</div>
	
			<div id="frame_image_upload">
				<div class="frame-drop">
					<div id="drop_area" class="rounded">
						<form class="my-form">
							<img src="{{ asset('images/drag.png') }}">
							<input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)">
							<label for="fileElem">Select some files or drag them here.</label>
							<div class="ajax" id="ajax_drag"><img src="{{ asset('images/ajax-white.svg') }}"></div>
						</form>
					</div>
				</div>
				<div class="frame-error-image">
					<div class="hide" id="hide_image"><div role="alert" id="error_image"></div></div>
				</div>
				<div id="photos" class='container' class="drag-container"></div>	
			</div>
			<div class="space-30"></div>
			<div class="space-30"></div>
			<div class="content">
				<h3>YouTube videos</h3>
				<ul>
					<li>You can link 2 YouTube videos.</li>
				</ul>
			</div>
		
		
				<div class="form">	
					<div id="video_link" class="row-data">
						<div class="label left"><label for="video">Video link:</label></div>
						<div class="star"></div>
						<div class="input"><input id="video" type="text" name="name" maxlength="191" placeholder="YouTube video link"></div>
					</div>
					<div class="hide" id="hide_video"><div role="alert" id="error_video"></div></div>

					<div id="video_button" class="row-data">
						<div class="label hide-field"></div>
						<div class="star hide-field"></div>
						<div class="input buttons video">
							<div><button id="btn_video">Save video</button></div>
						</div>
					</div>
					
					<div class="ajax" id="ajax_video"><img src="{{ asset('images/ajax.svg') }}"></div>

					<div id="frame_video" class="frame-video">
						<div id="video_1">
						  <iframe id="iframe_1" class="rounded" src="" frameborder="0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						  <button id="btn_delete_1"><img src="{{ asset('images/fa-trash.png') }}" alt="delete" title="delete"></button>
						</div>

						<div id="video_2">
						  <iframe id="iframe_2" class="rounded" src="" frameborder="0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						  <button id="btn_delete_2"><img src="{{ asset('images/fa-trash.png') }}" alt="delete" title="delete"></button>
						</div>
					</div>
					
					<div class="row-data">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input buttons video">
							<div>
								<a href="{{ url('/tutor/profile/subjects') }}">
									<div id="btn_form_next" class="btn-next rounded">Next step</div>
								</a>
							</div>
						</div>
					</div>
				</div>

		</div>
	</div>
</div>

<link rel="stylesheet" href="{{ asset('css/vendor/dragula.css') }}">
<script src="{{ asset('js/vendor/dragula.min.js') }}"></script>
	
@endsection



















