<?php

$js_file = 'home';
$css_file = 'home';

?>



<?php $__env->startSection('title'); ?>
	<?php echo app('translator')->get('home.title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
	<?php echo app('translator')->get('home.description'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="preloader">
	<!--<img src="<?php echo e(asset('images/preloader.svg')); ?>" alt="preloader">-->
</div>
	
<h1>Contact</h1>
<hr>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ingatlanom/domains/privatetutorhunt.com/resources/views//info/contact.blade.php ENDPATH**/ ?>