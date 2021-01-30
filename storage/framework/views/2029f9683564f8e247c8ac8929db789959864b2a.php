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
<input type="hidden" id="path" value="<?php echo e(public_path()); ?>">

<div class="frame-tutor">
	<?php echo $__env->make('user/profile-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
	<div class="frame-tutor-form">
		<div id="form_contact">
			<h2>MEDIA</h2>
			<hr class="blue-light">
			
			<div class="content">
				<h3>Images</h3>
				<ul>
					<li>You can upload maximum 8 images.</li>
					<li>Accepted file type: JPG</li>
					<li>Maximum file size: 8MB</li>
					<li>Please upload at least one image.</li>
					<li>After uploading you can order the images by drag and drop.</li>
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
				<div class="wrapper">
				<div id="photos" class='container' class="drag-container">
				
				</div>	
				</div>	
				
				
				
				
			</div>

			<form name="form_profile" id="form_profile"  onsubmit="return validate_form()" novalidate>
				<div class="form">	

					<div class="hide" id="hide_about"><div role="alert" id="error_about"></div></div>


					
					<div class="hide" id="hide_experience"><div role="alert" id="error_experience"></div></div>
					
					<div class="ajax" id="ajax_profile"><img src="<?php echo e(asset('images/ajax.svg')); ?>"></div>
					<div class="hide" id="hide_form"><div role="alert" id="error_form"></div></div>
					<div class="row-data">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input buttons">
							<div><button id="btn_form">Save</button></div>
							<div>
								<a href="<?php echo e(url('/tutor/profile/media')); ?>">
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

	<link rel="stylesheet" href="<?php echo e(asset('css/vendor/dragula.css')); ?>">
	<script src="<?php echo e(asset('js/vendor/dragula.min.js')); ?>"></script>
	
<?php $__env->stopSection(); ?>




















<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ingatlanom/domains/privatetutorhunt.com/resources/views/user/profile-media.blade.php ENDPATH**/ ?>