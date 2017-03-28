<?php $__env->startSection('title'); ?>
Welcome
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<header class="row" style="background-image:url('/images/headers/registration.jpg')">
	<div class="col-md-12">
	    <h1>Welcome</h1>
	</div>
    <div class="col-md-5 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo e(csrf_field()); ?>


                    <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
<!--                         <label for="email" class="col-md-4 control-label">E-Mail Address</label> -->

                        <div class="col-md-8 col-md-offset-2">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required autofocus>

                            <?php if($errors->has('email')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
<!--                         <label for="password" class="col-md-4 control-label">Password</label> -->

                        <div class="col-md-8 col-md-offset-2">
                            <input id="password" type="password" class="form-control" name="password" placeholder="password" required>

                            <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input  type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
	                    <p>
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
	                    </p>
						<p>
                        	<a href="<?php echo e(route('password.request')); ?>">
                        	    Forgot Your Password?
                        	</a>
						</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3">
		<div class="panel panel-default">
            <div class="panel-heading">New Here?</div>
            <div class="panel-body">
            	<a href="<?php echo route('register'); ?>"><button class="btn btn-primary">Register</button></a>
            </div>
        </div>
    </div>
</header>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>