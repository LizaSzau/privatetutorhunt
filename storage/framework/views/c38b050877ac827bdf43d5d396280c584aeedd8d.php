<?php

$js_file = 'profile-subject';
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

<input type="hidden" id="subject_number" value="<?php echo e($subject_number); ?>">
				
<div class="frame-tutor">
	<?php echo $__env->make('user/profile-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
	<div class="frame-tutor-form">
		<div id="form_subjects" class="form-subjects">
			<h2>SUBJECTS</h2>
			<hr class="blue-light">

			<div class="content">
				<ul>
					<li>Please upload at least one subject.</li>
				</ul>
			</div>
			
			<form name="form_profile" id="form_profile"  onsubmit="return validate_form()" novalidate>
				<div class="form">	
				
					<div class="row-data">
						<div class="label"><label for="select_subject">Subjects:</label></div>
						<div class="star"></div>
						<div class="select input">
							<img src="<?php echo e(asset('images/fa-down.png')); ?>" alt="Select subject">
							<select name="select_subject" id="select_subject">
								<option value="0">Select subject</option>
				
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option class="category-name" disabled><?php echo e($category->name); ?></option>
									<?php $__currentLoopData = $category->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option class="option" value="<?php echo e($subject->id); ?>"><?php echo e($subject->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								
							</select>
						</div>
					</div>
	
					<div class="row-data">
						<div class="label"><label for="select_level">Level:</label></div>
						<div class="star"></div>
						<div class="select input">
							<img src="<?php echo e(asset('images/fa-down.png')); ?>" alt="Select subject">
							<select name="select_level" id="select_level">
								<option value="0">Select level</option>
							
								<?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option class="option" value="<?php echo e($level->id); ?>"><?php echo e($level->level); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								
							</select>
						</div>
					</div>
			
					<div class="row-data">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input buttons add">
							<div><button id="btn_add">Add</button></div>
						</div>
					</div>
					
					<h3>Selected subjects:</h3>
					
					<div id="tutor_subjects">	
						<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div id="<?php echo e($subject->subject_id); ?>_<?php echo e($subject->level_id); ?>">
								<button onclick="delete_item('<?php echo e($subject->subject_id); ?>_<?php echo e($subject->level_id); ?>')"><img src="<?php echo e(asset('images/fa-trash.png')); ?>" alt="delete" title="delete"></button>
								<span class="subject"><?php echo e($subject->name); ?></span> - <?php echo e($subject->level); ?>

							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					
					<div class="hide" id="hide_delete"><div role="alert" id="error_delete"></div></div>
					
					<div class="row-data">
						<div class="label"></div>
						<div class="star"></div>
						<div class="input buttons subject">
							<div>
								<a href="<?php echo e(url('/tutor/profile/locations')); ?>">
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




















<?php echo $__env->make('index.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WebDevelopment\www\privatetutorhunt.com\resources\views/user/profile-subjects.blade.php ENDPATH**/ ?>