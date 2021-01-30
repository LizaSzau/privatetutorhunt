<?php

$js_file = 'search';
$css_file = 'search';

?>



<?php $__env->startSection('title'); ?>
	<?php echo app('translator')->get('search.title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
	<?php echo app('translator')->get('search.description'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="preloader">
	<!--<img src="<?php echo e(asset('images/preloader.svg')); ?>" alt="preloader">-->
</div>

<h1><?php echo app('translator')->get('search.title-h1'); ?></h1>
<hr>

<div class="search-frame">

<?php $__currentLoopData = $dataCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div>
		<div class="category"><a href="<?php echo e($cat->category_id); ?>"><h2><?php echo e($cat->category_name); ?></h2></a><hr></div>
		<div class="subject">
		<?php
		
			$subjects = explode(';', $cat->subjects);
			
			foreach($subjects as $sub) {
				$subject = explode('*', $sub);
				echo '<a href="'.$subject[2].'">
						<span class="cloud rounded">
							<h3>'.$subject[0].'</h3>
							<span class="number">'.$subject[1].'</span>
						</span>
					</a>';
			}
			
		?>
		</div>
	</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WebDevelopment\www\privatetutorhunt.com\resources\views/search/index.blade.php ENDPATH**/ ?>