<div class="frame-tutor-status">
	<div class="status-main">
		<div class="status-item">
			<div><a href="<?php echo e(url('/tutor/profile/contact')); ?>">Contact</a></div>
			<div id="pm_contact" <?php if($tutor_ready->contact == 1): ?> class="tutor-menu-green" <?php endif; ?>><img src="<?php echo e(asset('images/fa-tick.png')); ?>"></div>
		</div>
		<div class="status-item">
			<div><a href="<?php echo e(url('/tutor/profile/about')); ?>">About you</a></div>
			<div id="pm_about" <?php if($tutor_ready->about == 1): ?> class="tutor-menu-green" <?php endif; ?>><img src="<?php echo e(asset('images/fa-tick.png')); ?>"></div>
		</div>
		<div class="status-item">
			<div><a href="<?php echo e(url('/tutor/profile/media')); ?>">Media</a></div>
			<div id="pm_media" <?php if($tutor_ready->media == 1): ?> class="tutor-menu-green" <?php endif; ?>><img src="<?php echo e(asset('images/fa-tick.png')); ?>"></div>
		</div>
		<div class="status-item">
			<div><a href="<?php echo e(url('/tutor/profile/subjects')); ?>">Subjects</a></div>
			<div id="pm_subjects" <?php if($tutor_ready->subjects == 1): ?> class="tutor-menu-green" <?php endif; ?>><img src="<?php echo e(asset('images/fa-tick.png')); ?>"></div>
		</div>
		<div class="status-item">
			<div><a href="<?php echo e(url('/tutor/profile/contact')); ?>">Locations</a></div>
			<div><img src="<?php echo e(asset('images/fa-tick.png')); ?>"></div>
		</div>
		<div class="status-item">
			<div><a href="<?php echo e(url('/tutor/profile/contact')); ?>">Details</a></div>
			<div><img src="<?php echo e(asset('images/fa-tick.png')); ?>"></div>
		</div>
		<div class="status-item">
			<div><a href="<?php echo e(url('/tutor/profile/contact')); ?>">Active</a></div>
			<div><img src="<?php echo e(asset('images/fa-tick.png')); ?>"></div>
		</div>
	</div>
</div>  

<?php /**PATH D:\WebDevelopment\www\privatetutorhunt.com\resources\views/user/profile-menu.blade.php ENDPATH**/ ?>