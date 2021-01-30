<div class="nav">
	<ul>
		<li>
			<a href="<?php echo e(url('/')); ?>" alt="Home" title="Home">
				<img src="<?php echo e(asset('images/fa-home.png')); ?>" class="fa-png" alt="Home">
				<span class="link">Home</span>
			</a>
			<div class="active-menu <?php if(Route::current()->getName() == 'guest_home'): ?> active <?php endif; ?> "></div>
		</li>
		<li>
			<a href="<?php echo e(url('/tutor-subjects-list')); ?>" alt="list">
				<img src="<?php echo e(asset('images/fa-search.png')); ?>" class="fa-png" alt="Subjects" title="Subjects">
				<span class="link">Subjects</span>
			</a>
			<div class="active-menu <?php if(Route::current()->getName() == 'search'): ?> active <?php endif; ?> "></div>
		</li>
		<li>
			<a href="<?php echo e(url('/favorites')); ?>" alt="list">
				<img src="<?php echo e(asset('images/fa-favorites.png')); ?>" class="fa-png" alt="Favorites" title="Favorites">
				<span class="link">Favorites</span>
			</a>
			<div class="active-menu <?php if(Route::current()->getName() == 'favorites'): ?> active <?php endif; ?> "></div>
		</li>
		<?php if(auth()->guard()->guest()): ?>
		<li>
		<?php endif; ?>
		<?php if(auth()->guard()->check()): ?>
		<li id="user_menu">
		<?php endif; ?>
			<?php if(auth()->guard()->guest()): ?>
				<img src="<?php echo e(asset('images/fa-login.png')); ?>" id="img_login" class="fa-png" alt="Login">
				<a id="btn_login" alt="Login">Login</a>
			<?php endif; ?>
			<?php if(auth()->guard()->check()): ?>
				<?php if(Auth::user()->avatar): ?>
					<img src="<?php echo e(Auth::user()->avatar); ?>" class="avatar" title="<?php echo e(Auth::user()->name); ?>">
				<?php else: ?> 
					<img src="<?php echo e(asset('images/default-user.png')); ?>" class="avatar" title="<?php echo e(Auth::user()->name); ?>">
				<?php endif; ?>
				<a>Menu</a>	
				<div class="active-menu <?php if(Route::current()->getName() == 'user_home'): ?> active <?php endif; ?> "></div>		
					<div class="user-menu-items collapsible collapsed">
						<div class="border"></div>
						<a href="<?php echo e(url('/tutor/dashboard')); ?>" <?php if(Route::current()->getName() == 'user_home'): ?> class="active" <?php endif; ?> alt="Dashboard">Info</a>	
						<a href="<?php echo e(url('/tutor/profile/contact')); ?>" <?php if(Route::current()->getName() == 'user_profile_contact'): ?> class="active" <?php endif; ?> alt="Your profile">Your profile</a>
						<a href="#">Activities</a>
						<a href="#">Personal data</a>
						<a>
							<form action="<?php echo e(url('logout')); ?>" method="POST">
								<?php echo e(csrf_field()); ?>

								<button type="submit">Logout</button>
							</form>
						</a>
					</div>
			<?php endif; ?>
		</li>
	</ul>
</div>	<?php /**PATH /home/ingatlanom/domains/privatetutorhunt.com/resources/views/index/nav.blade.php ENDPATH**/ ?>