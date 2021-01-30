

<?php $__env->startSection('title'); ?>
	<?php echo app('translator')->get('mail.verify-subject'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subject'); ?>
	<?php echo app('translator')->get('mail.verify-subject'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('message'); ?>
	<?php echo app('translator')->get('mail.verify_dear'); ?> <?php echo e($user['name']); ?>!
	<p><?php echo app('translator')->get('mail.verify-message-1'); ?></p>
	<p><?php echo e($user['email']); ?></p>
	<p><?php echo app('translator')->get('mail.verify-message-2'); ?></p>
	<p>
		<a href="<?php echo e(url(trans('auth.verifyLink'), $user->verifyUser->token)); ?>">
			<button style="background: #29295e; font-size: 16px; color: #FFFFFF; padding: 20px; border: 1px solid #29295e; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px;"><?php echo app('translator')->get('mail.verify-subject'); ?></button>
		</a>
	</p>
	<p style="color: #455A64; font-size: 12px;"><?php echo app('translator')->get('mail.email-link-trouble'); ?> <?php echo e(url(trans('auth.verify-link'), $user->verifyUser->token)); ?></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('mails.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WebDevelopment\www\privatetutorhunt.com\resources\views/mails/verify_user_mail.blade.php ENDPATH**/ ?>