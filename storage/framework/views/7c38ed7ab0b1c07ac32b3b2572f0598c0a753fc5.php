<?php

$js_file = 'user';
$css_file = 'user';

?>



<?php $__env->startSection('title'); ?>
	<?php echo app('translator')->get('user.title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
	<?php echo app('translator')->get('user.description'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="preloader">
	<!--<img src="<?php echo e(asset('images/preloader.svg')); ?>" alt="preloader">-->
</div>
	
<h1><?php echo app('translator')->get('user.title-h1'); ?></h1>
<hr>
<h2>Hello <?php echo e(Auth::user()->name); ?>!</h2>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ingatlanom/domains/privatetutorhunt.com/resources/views//user/index.blade.php ENDPATH**/ ?>