<?php

$js_file = 'reset-password';
$css_file = 'register';

?>



<?php $__env->startSection('title'); ?>
	<?php echo app('translator')->get('auth.title-reset-password'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
	<?php echo app('translator')->get('auth.description-reset-password'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="preloader">
	<!--<img src="<?php echo e(asset('images/preloader.svg')); ?>" alt="preloader">-->
</div>
	
<h1><?php echo app('translator')->get('auth.title-h1-reset-password'); ?></h1>
<hr>

<form method="POST" action="<?php echo e(route('password.email')); ?>" name="form_reset_password" onsubmit="return validate_form()" novalidate>
<?php echo csrf_field(); ?>

	<div class="register-frame">
	
		<?php if(session('status')): ?>
		<div class="message-success">
			<div role="alert"><?php echo e(session('status')); ?></div> 
		</div>
		<?php endif; ?>

		<div class="row-data">
			<div class="label"><label for="email" class="col-md-4 col-form-label text-md-right">E-mail:</label></div>
			<div class="input"><input id="email_reset" type="email" class="" name="email" value="<?php echo e(old('email')); ?>" autocomplete="email" autofocus></div>
		</div>
		<div class="hide" id="hide_email"><div role="alert" id="error_email"></div></div>
		
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

		<div class="row-data">
			<div class="label"></div>
			<div class="input"><button id="button_submit" class="btn-reset" type="submit">Send password reset link</button></div>
		</div>
	</div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ingatlanom/domains/privatetutorhunt.com/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>