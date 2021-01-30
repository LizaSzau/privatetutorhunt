<?php

$js_file = 'profile-about';
$css_file = 'profile';

?>



<?php $__env->startSection('title'); ?>
	<?php echo app('translator')->get('user.title-profile-about'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
	<?php echo app('translator')->get('user.description-profile-about'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="preloader">
	<!--<img src="<?php echo e(asset('images/preloader.svg')); ?>" alt="preloader">-->
</div>
	
<h1>Your tutor profile</h1>
<hr>

<div class="frame-tutor">
	<?php echo $__env->make('user/profile-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
	<div class="frame-tutor-form">
		<div id="form_contact">
			<h2>ABOUT YOU</h2>
			<hr class="blue-light">

			<form name="form_profile" id="form_profile"  onsubmit="return validate_form()" novalidate>
				<div class="form">	
					<div class="row-data">
						<div class="label"><label for="name">Title:</label></div>
						<div class="star">*</div>
						<div class="input"><input id="title" type="text" name="title" maxlength="100" placeholder="Title your profile"
							value="<?php echo e((!empty($tutor[0]->title) ? $tutor[0]->title : '')); ?>"
						></div>
					</div>
					<div class="hide" id="hide_title"><div role="alert" id="error_title"></div></div>
					
					<div class="row-data">
						<div class="label"><label for="about_you">About you:</label></div>
						<div class="star">*</div>
						<div class="input">
							<textarea id="about" type="text" name="about" maxlength="191" rows="10"placeholder="About you, your teaching style..."><?php echo e((!empty($tutor[0]->about_you) ? $tutor[0]->about_you : '')); ?></textarea>
						</div>
					</div>
					<div class="hide" id="hide_about"><div role="alert" id="error_about"></div></div>

					<div class="row-data">
						<div class="label"><label for="c_name">Education:</label></div>
						<div class="star">*</div>
						<div class="input">
							<textarea id="education" type="text" name="education" maxlength="191" rows="5"placeholder="Your qualifications and studies."><?php echo e((!empty($tutor[0]->about_education) ? $tutor[0]->about_education : '')); ?></textarea>
						</div>
					</div>
					<div class="hide" id="hide_education"><div role="alert" id="error_education"></div></div>
					
					<div class="row-data">
						<div class="label"><label for="c_name">Experience:</label></div>
						<div class="star">*</div>
						<div class="input">
							<textarea id="experience" type="text" name="experience" maxlength="191" rows="5"placeholder="Your teaching experience."><?php echo e((!empty($tutor[0]->about_experience) ? $tutor[0]->about_experience : '')); ?></textarea>
						</div>
					</div>
					
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

<?php $__env->stopSection(); ?>




















<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WebDevelopment\www\privatetutorhunt.com\resources\views/user/profile-about.blade.php ENDPATH**/ ?>