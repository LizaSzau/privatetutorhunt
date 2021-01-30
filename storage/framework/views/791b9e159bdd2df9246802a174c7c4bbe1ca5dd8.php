<?php

$js_file = 'register';
$css_file = 'register';

?>



<?php $__env->startSection('title'); ?>
	<?php echo app('translator')->get('auth.title-register'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
	<?php echo app('translator')->get('auth.description-register'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="preloader">
	<!--<img src="<?php echo e(asset('images/preloader.svg')); ?>" alt="preloader">-->
</div>
	
<h1><?php echo app('translator')->get('auth.title-h1-register'); ?></h1>
<hr>
<h2>FOR TUTORS AND TEACHERS</h2>
If you are a tutor or teacher please register or log in with one of your social media account.
<h2>FOR STUDENTS</h2>
If you are a student looking for a tutor or teacher, you don't need to register.
<div class="space-30"></div>
<hr class="reg">

<h2>REGISTRATION FORM</h2>
<div class="space-30"></div>

<form method="POST" action="<?php echo e(route('register')); ?>" name="form_register" onsubmit="return validate_form()" novalidate>
	<?php echo csrf_field(); ?>
	<div class="register-frame">	
		<div class="row-data">
			<div class="label"><label for="name">Name:</label></div>
			<div class="input"><input id="name" type="text" class="<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus placeholder="Your name" maxlength="191"></div>
		</div>
		<div class="hide" id="hide_name"><div role="alert" id="error_name"></div></div>
		
		<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		<div class="message-error">
			<div role="alert"><?php echo e($message); ?></div> 
		</div>
		<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
		
		<div class="row-data">
			<div class="label"><label for="email">E-mail:</label></div>
			<div class="input"><input id="email_reg" type="email" class="<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" autocomplete="email" autofocus placeholder="Your e-mail" maxlength="191"></div>
		</div>
		<div class="hide" id="hide_email"><div role="alert" id="error_email"></div></div>
		
		<div id="email_laravel">
		<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		<div class="message-error">
			 <div role="alert"><?php echo e($message); ?></div> 
		</div>
		<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
		</div>
		
		<div class="row-data">
			<div class="label"><label for="password">Password:</label></div>
			<div class="input"><input id="password_reg" type="password" class="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" autocomplete="new-password" autofocus placeholder="Password" maxlength="191"></div>
		</div>
		<div class="hide" id="hide_password"><div role="alert" id="error_password"></div></div>
		
		<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		<div class="message-error">
			 <div role="alert"><?php echo e($message); ?></div> 
		</div>
		<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
		
		<div class="row-data">
			<div class="label"><label for="password-confirm">Confirm password:</label></div>
			<div class="input"><input id="password_reg_confirm" type="password" name="password_confirmation" autocomplete="new-password" autofocus placeholder="Password" maxlength="191"></div>
		</div>
		<div class="hide" id="hide_password_confirm"><div role="alert" id="error_password_confirm"></div></div>
		
		<div class="row-data">
			<div class="label"></div>
			<div class="input"><button id="button_submit" type="submit">Register</button></div>
		</div>
	</div>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ingatlanom/domains/privatetutorhunt.com/resources/views/auth/register.blade.php ENDPATH**/ ?>