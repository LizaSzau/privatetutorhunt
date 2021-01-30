<?php

$js_file = 'profile-contact';
$css_file = 'profile';

?>



<?php $__env->startSection('title'); ?>
	<?php echo app('translator')->get('user.title-profile-contact'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
	<?php echo app('translator')->get('user.description-profile-contact'); ?>
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
			<h2>CONTACT</h2>
			<hr class="blue-light">

			<form name="form_profile" id="form_profile" onsubmit="return validate_form()" novalidate>
				<div class="form">	
					<div class="row-data">
						<div class="label"><label for="name">Name:</label></div>
						<div class="star">*</div>
						<div class="input"><input id="name" type="text" name="name" maxlength="191" placeholder="Your public name"
							value="<?php echo e((!empty($tutor[0]->name) ? $tutor[0]->name : '')); ?>"
						></div>
					</div>
					<div class="hide" id="hide_name"><div role="alert" id="error_name"></div></div>

					<div class="row-data">
						<div class="label"><label for="c_email">E-mail:</label></div>
						<div class="star"></div>
						<div class="input"><input id="c_email" type="text" name="c_email" value="<?php echo e(Auth::user()->email); ?>" disabled maxlength="191"></div>
					</div>

					<div class="row-data checkbox">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input">
							<div><input type="checkbox" id="email_visible" name="email_visible" <?php if(!$tutor[0]->email_visible == 0): ?> checked="checked" <?php endif; ?>></div>
							<div><label for="email_visible">E-mail address is visible on your profile.</label></div>
						</div>
					</div>

					<div class="row-data checkbox">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input">
							<div><input type="checkbox" id="email_web" name="email_web" <?php if(!$tutor[0]->email_web== 0): ?> checked="checked" <?php endif; ?>></div>
							<div><label for="email_web">Students can e-mail you via our webpage even if your e-mail address is hidden.</label></div>
						</div>
					</div>

					<div class="space-20"></div>

					<div class="row-data">
						<div class="label"><label for="phone_1">Phone 1:</label></div>
						<div class="star"></div>
						<div class="input phone">
							<input class="phone-area" onkeypress="return isNumberKey(event)" id="phone_area_1" type="tel" name="phone_area_1" maxlength="5" placeholder="Area code"
								value="<?php echo e((!empty($tutor[0]->phone_area_1) ? $tutor[0]->phone_area_1 : '')); ?>"> 
							<div>-</div>
							<input class="phone-number" onkeypress="return isNumberKey(event)" id="phone_number_1" type="tel" name="phone_number_1" maxlength="8" placeholder="Number"
								value="<?php echo e((!empty($tutor[0]->phone_number_1) ? $tutor[0]->phone_number_1 : '')); ?>"> 
						</div>
					</div>
					<div class="hide" id="hide_phone_1"><div role="alert" id="error_phone_1"></div></div>

					<div class="row-data">
						<div class="label"><label for="phone_2">Phone 2:</label></div>
						<div class="star"></div>
						<div class="input phone">
							<input class="phone-area" onkeypress="return isNumberKey(event)" id="phone_area_2" type="tel" name="phone_area_2" maxlength="5" placeholder="Area code"
								value="<?php echo e((!empty($tutor[0]->phone_area_2) ? $tutor[0]->phone_area_2 : '')); ?>">
							<div>-</div>
							<input class="phone-number" onkeypress="return isNumberKey(event)" id="phone_number_2" type="tel" name="phone_number_2" maxlength="8" placeholder="Number"
								value="<?php echo e((!empty($tutor[0]->phone_number_2) ? $tutor[0]->phone_number_2 : '')); ?>">
						</div>
					</div>
					<div class="hide" id="hide_phone_2"><div role="alert" id="error_phone_2"></div></div>

					<div class="row-data">
						<div class="label"><label for="webpage">Webpage:</label></div>
						<div class="star"></div>
						<div class="input">
							<input id="webpage" type="text" name="webpage" maxlength="191" 
								value="<?php echo e((!empty($tutor[0]->webpage) ? $tutor[0]->webpage : '')); ?>" placeholder="Link of your webpage">
						</div>
					</div>
					<div class="hide" id="hide_webpage"><div role="alert" id="error_webpage"></div></div>

					<div class="row-data">
						<div class="label"><label for="facebook">Facebook:</label></div>
						<div class="star"></div>
						<div class="input">
							<input id="facebook" type="text" name="facebook" maxlength="191" placeholder="User name"
								value="<?php echo e((!empty($tutor[0]->facebook) ? $tutor[0]->facebook : '')); ?>">
						</div>
					</div>
					<div class="hide" id="hide_facebook"><div role="alert" id="error_facebook"></div></div>

					<div class="ajax" id="ajax_profile"><img src="<?php echo e(asset('images/ajax.svg')); ?>"></div>
					<div class="hide" id="hide_form"><div role="alert" id="error_form"></div></div>
					<div class="row-data">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input buttons">
							<div><button id="btn_form">Save</button></div>
							<div>
								<a href="<?php echo e(url('/tutor/profile/about')); ?>">
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




















<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ingatlanom/domains/privatetutorhunt.com/resources/views/user/profile-contact.blade.php ENDPATH**/ ?>