<?php

$js_file = 'profile-media';
$css_file = 'profile';

?>



<?php $__env->startSection('title'); ?>
	<?php echo app('translator')->get('user.title-profile-media'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
	<?php echo app('translator')->get('user.description-profile-media'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="preloader">
	<!--<img src="<?php echo e(asset('images/preloader.svg')); ?>" alt="preloader">-->
</div>
	
<h1>Your tutor profile</h1>
<hr>

<input type="hidden" id="image_number" value="<?php echo e($image_number); ?>">
<input type="hidden" id="video_number" value="<?php echo e($video_number); ?>">
<input type="hidden" id="path" value="<?php echo e(public_path()); ?>">

<div class="frame-tutor">
	<?php echo $__env->make('user/profile-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
	<div class="frame-tutor-form">
		<div>
			<h2>MEDIA</h2>
			<hr class="blue-light">
			
			<div class="content">
				<h3>Images</h3>
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
	
			<div id="frame_image_upload">
				<div class="frame-drop">
					<div id="drop_area" class="rounded">
						<form class="my-form">
							<img src="<?php echo e(asset('images/drag.png')); ?>">
							<input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)">
							<label for="fileElem">Select some files or drag them here.</label>
							<div class="ajax" id="ajax_drag"><img src="<?php echo e(asset('images/ajax-white.svg')); ?>"></div>
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
					
					<div class="ajax" id="ajax_video"><img src="<?php echo e(asset('images/ajax.svg')); ?>"></div>
					
					<div id="frame_video" class="frame-video">
						<div id="video_1">
						  <iframe id="iframe_1" class="rounded" src="" frameborder="0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						  <button id="btn_delete_1"><img src="<?php echo e(asset('images/fa-trash.png')); ?>" alt="delete" title="delete"></button>
						</div>
						<div id="video_2">
						  <iframe id="iframe_2" class="rounded" src="" frameborder="0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						  <button id="btn_delete_2"><img src="<?php echo e(asset('images/fa-trash.png')); ?>" alt="delete" title="delete"></button>
						</div>
					</div>

					<div class="row-data">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input buttons video">
							<div>
								<a href="<?php echo e(url('/tutor/profile/subjects')); ?>">
									<div id="btn_form_next" class="btn-next rounded">Next step</div>
								</a>
							</div>
						</div>
					</div>
				</div>

		</div>
	</div>
</div>

<link rel="stylesheet" href="<?php echo e(asset('css/vendor/dragula.css')); ?>">
<script src="<?php echo e(asset('js/vendor/dragula.min.js')); ?>"></script>
	
<?php $__env->stopSection(); ?>




















<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WebDevelopment\www\privatetutorhunt.com\resources\views/user/profile-media.blade.php ENDPATH**/ ?>