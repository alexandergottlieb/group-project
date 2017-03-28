<?php $__env->startSection('title'); ?>
Share
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row backdrop">
	<div class="col-md-8 col-md-offset-2">
		<form action="/api/foods" method="POST" class="panel panel-default geocode" enctype="multipart/form-data">
            <div class="panel-heading">Share Food</div>
            <div class="panel-body">
	            <?php if(count($errors)): ?>
				    <div class="alert alert-danger">
				        <ul>
				            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                <li><?php echo e($error); ?></li>
				            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				        </ul>
				    </div>
				<?php endif; ?>
                <div class="form-group">
	                <label>Name</label>
	                <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>">
                </div>
                <div class="form-group">
	                <label>Description</label>
	                <textarea name="description" class="form-control"><?php echo e(old('description')); ?></textarea>
                </div>
                <div class="form-group">
	                <label>Add a picture</label>
	                <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
	                <label>Address</label>
	                <input type="text" name="address" class="geocode-address form-control" value="<?php echo e(old('address')); ?>">
	                <input type="hidden" name="latitude" class="geocode-latitude">
	                <input type="hidden" name="longitude" class="geocode-longitude">
                </div>
                <div class="form-group">
	                <label>Best Before Date</label>
	                <input type="date" name="best_before" class="form-control" value="<?php echo e(old('best_before')); ?>">
	            </div>
	            <div class="form-group">
		            <label>Category</label><br>
		            <label class="radio-inline">
						<input type="radio" name="category" value="fruit" <?php if(old('category') === 'fruit'): ?> checked <?php endif; ?>>Fruit
					</label>
		            <label class="radio-inline">
						<input type="radio" name="category" value="vegetable" <?php if(old('category') === 'vegetable'): ?> checked <?php endif; ?>>Vegetable
					</label>
		            <label class="radio-inline">
						<input type="radio" name="category" value="meat" <?php if(old('category') === 'meat'): ?> checked <?php endif; ?>>Meat
					</label>
					<label class="radio-inline">
						<input type="radio" name="category" value="dairy" <?php if(old('category') === 'dairy'): ?> checked <?php endif; ?>>Dairy
					</label>
	            </div>
            </div>
            <div class="panel-footer alignright">
				<input type="submit" value="Share" class="btn btn-primary">
            </div>
            <?php echo e(csrf_field()); ?>

		</form>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>