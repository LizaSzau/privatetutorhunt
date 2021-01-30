<?php

$js_file = 'login';
$css_file = 'login';

?>



<?php $__env->startSection('title'); ?>
	<?php echo app('translator')->get('auth.title-login'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
	<?php echo app('translator')->get('auth.description-login'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="preloader">
	<!--<img src="<?php echo e(asset('images/preloader.svg')); ?>" alt="preloader">-->
</div>
	
<h1><?php echo app('translator')->get('auth.title-h1-login'); ?></h1>
<hr>

<?php if(session('restricted_user')): ?>
	<div class="message-error">
		<div>We are really sorry but you have been banned.</div>
	</div>
<?php endif; ?>

<?php if(session('not_verified')): ?>
	<div class="message-warning">
		<div>
			You registered but haven't verified you e-mail address yet.
			<br>Please check your mail box and follow the instruction. 
			<br>If you don't find our mail, please check your spam folder.
			<br>If you have still problem with e-mail verification, please contact us.
		</div>
	</div>
<?php endif; ?>

<?php if(session('email_already_verified')): ?>
	<div class="message-warning">
		<div>
			You have already verified your e-mail address.
			<br>Now you can login with your e-mail and password to create your tutor profile.
		</div>
	</div>
<?php endif; ?>

<?php if(session('email_verified')): ?>
	<div class="message-success">
		<div>
			Congratulation! You verified you e-mail address successfully.
			<br>Now you can login with your e-mail and password to create your tutor profile.
		</div>
	</div>
<?php endif; ?>

<?php if(session('email_not_verified')): ?>
	<div class="message-error">
		<div>
			We are very sorry about your e-mail address confirmation failed.
			<br>Please contact us to solve this problem.
		</div>
	</div>
<?php endif; ?>
<?php if($errors->any()): ?>
	<div class="message-error rounded" role="alert">
		<?php echo implode('', $errors->all('<div class="error">:message</div>')); ?>

	</div>
<?php endif; ?>

<div class="login">
	<?php echo $__env->make('auth/login_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WebDevelopment\www\privatetutorhunt.com\resources\views/auth/login.blade.php ENDPATH**/ ?>