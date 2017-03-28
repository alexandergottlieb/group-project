<?php $__env->startSection('title'); ?>
Account
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<header class="row" style="background-image:url('/images/headers/home.jpg')">
	<div class="col-md-12">
	    <h1>Account</h1>
	</div>
</header>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Your Food
				</div>
	            <div class="panel-body">
		            <?php if(!empty(Auth::user()->foods)): ?>
		            	<ul class="list-group">
		            	<?php $__currentLoopData = Auth::user()->foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			            	<li class="food list-group-item">
				            	<div class="food-details">
					            	<h4 class="list-group-item-heading"><?php echo e($food->name); ?></h4>
								    <time class="food-best-before"><?php echo e(date('jS M Y', $food->best_before->timestamp)); ?></time>
									<p class="list-group-item-text"><?php echo e($food->description); ?></p>
				            	</div>
								<figure class="food-image">
									<img src="<?php echo e(Storage::url($food->image)); ?>">
								</figure>
							</li>
		            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		            <?php else: ?>
		            	<p>You have not added any food, let's <a href="/share">share</a> now!</p>
		            <?php endif; ?>
	            </div>
	            <div class="panel-footer alignright">
					<a class="btn btn-primary" href="/share">Add More</a>
	            </div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					Messages
				</div>
	            <div class="panel-body">
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
						<p>You have no messages yet.</p>
		            <?php endif; ?>
	            </div>
	            <div class="panel-footer alignright">
					<a class="btn btn-primary" href="/account/messages">View All</a>
	            </div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					Settings
				</div>
	            <div class="panel-body">
		            <code>Change Password</code>
	            </div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>