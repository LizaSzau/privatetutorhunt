<?php echo $__env->make('index/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body>  
	<div id="app">
		<div class="header-frame">
			<div class="header">
				<?php echo $__env->make('index/logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php echo $__env->make('index/search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		</div>	
		
		<div class="nav-frame">
			<?php echo $__env->make('index/nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>	
		
		<div class="content-frame">
			<?php echo $__env->yieldContent('content'); ?>
		</div>
		
		<div class="footer-frame">
			<?php echo $__env->make('index/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	</div>
		
	<div class="modal rounded" id="modal_login">
		<div class="close"><div id="close">x</div></div>
		<?php echo $__env->make('auth/login_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
	
	<link rel="stylesheet" href="<?php echo e(asset('css/'.$css_file.'.css')); ?>">
	<script src="<?php echo e(asset('js/index.js')); ?>"></script>
	<script src="<?php echo e(asset('js/'.$js_file.'.js')); ?>"></script>
	
</body>

</html><?php /**PATH D:\WebDevelopment\www\privatetutorhunt.com\resources\views/index/index.blade.php ENDPATH**/ ?>