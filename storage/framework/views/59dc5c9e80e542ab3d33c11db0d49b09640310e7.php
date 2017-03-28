<?php $__env->startSection('title'); ?>
Account
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h1>Messages</h1>
			<?php if(isset($messages)): ?>
				<ul class="list-group">
					<?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="/account/messages/<?php echo e($m->id); ?>">
							<li class="list-group-item">
						    	<h4 class="list-group-item-heading"><?php echo e($m->subject); ?></h4>
								<p class="list-group-item-text"><?php echo e(substr($m->content, 0, 140)); ?>...</p>
								<time class="pull-right"><?php echo e($m->created_at); ?></time>
							</li>
					    </a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			<?php else: ?>
				<p>You have not received any messages yet! :(</p>
			<?php endif; ?>
		</div>
		<div class="col-md-4">
			<?php if(isset($message)): ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<?php echo e($message->subject); ?>

						<time class="pull-right"><?php echo e($message->created_at); ?></time>
					</div>
		            <div class="panel-body">
			            <?php echo e($message->content); ?>

		            </div>
		            <form class="panel-footer form-horizontal">
			            <?php echo e(method_field('POST')); ?>

			            <div class="form-group">
				            <textarea name="message" class="form-control" placeholder="Reply"></textarea>
				            <input type="hidden" name="to" value="<?php echo e($message->from); ?>">
							<a class="btn btn-primary" href="/account/messages">Send</a>
			            </div>
			            <?php echo e(csrf_field()); ?>

		            </form>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>