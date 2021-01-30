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
	
<h1><?php echo app('translator')->get('home.title-h1'); ?></h1>
<hr>

<div class="under-construction rounded">
	THIS SITE IS UNDER CONSTRUCTION.
	<br>IT IS EXPECTED TO START IN JANUARY OF 2021.
</div>
	
<div class="categ-flex-frame">

<?php $__currentLoopData = $dataCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	<?php if($cat->subjects != ''): ?>
		<div style="background: url(<?php echo e(asset('images/tiles/'.$cat->slug.'.jpg')); ?>)" class="tile">
			<div class="color color-<?php echo e($cat->id); ?>">
				<div class="categ"><h2><?php echo e($cat->category_name); ?></h2></div>
				<div class="subjects"><?php echo $cat->subjects; ?></div>
			</div>
		</div>
	<?php else: ?>
		<div style="background: url(<?php echo e(asset('images/tiles/'.$cat->slug.'.jpg')); ?>)" class="tile tile-gray">
			<div class="color color-gray">
				<div class="categ"><h2><?php echo e($cat->category_name); ?></h2></div>
			</div>
		</div>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WebDevelopment\www\privatetutorhunt.com\resources\views/home/index.blade.php ENDPATH**/ ?>