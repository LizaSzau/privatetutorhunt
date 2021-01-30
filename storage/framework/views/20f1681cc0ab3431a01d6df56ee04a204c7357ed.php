<?php

$js_file = 'dashboard';
$css_file = 'dashboard';

?>



<?php $__env->startSection('title-dashboard'); ?>
	<?php echo app('translator')->get('user.title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
	<?php echo app('translator')->get('user.description-dashboard'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="preloader">
	<!--<img src="<?php echo e(asset('images/preloader.svg')); ?>" alt="preloader">-->
</div>
	
<h1>Hello <?php echo e(Auth::user()->name); ?>!</h1>
<hr>
<div class="frame-dashboard">
	<h2>YOUR PROFILE</h2>
	<hr class="blue-light">

	<?php if(Auth::user()->tutor->ready_flag == 0): ?>
		You have not create your profile yet. 
		<br><br><a href="<?php echo e(url('tutor/profile/contact')); ?>" class="link-main">Click here to create your tutor profile.</a>
	<?php endif; ?>
	
	<hr class="blue-light logout">
	<div class="logout">
		<form id="logout-form" action="<?php echo e(url('logout')); ?>" method="POST">
			<?php echo e(csrf_field()); ?>

			<button type="submit">Logout</button>
		</form>
	</div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ingatlanom/domains/privatetutorhunt.com/resources/views//user/dashboard.blade.php ENDPATH**/ ?>