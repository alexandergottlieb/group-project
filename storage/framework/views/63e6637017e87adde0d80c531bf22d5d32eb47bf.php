<?php $__env->startSection('content'); ?>
<header class="row" style="background-image:url('/images/headers/contact.jpg')">
	<div class="col-md-12">
	    <h1>Contact Us</h1>
        <h2 class = "contact_phone">phone: 0300 123 456</h2>
        <h2 class = "contact_email">email: theteam@harvest.com</h2>
	</div>
</header>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>