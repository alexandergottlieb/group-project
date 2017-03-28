<?php
	define('APP_NAME', 'Harvest');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
        	<?php if (! empty(trim($__env->yieldContent('title')))): ?>
            	<?php echo $__env->yieldContent('title'); ?> | <?php echo e(APP_NAME); ?>

			<?php else: ?>
            	<?php echo e(APP_NAME); ?>

			<?php endif; ?>
        </title>
		
		<!-- Bootstrap -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
        
		<!-- Styles -->
		<link rel="stylesheet" href="/css/style.css?v=<?php echo filemtime(public_path('css/style.css')); ?>">
		
    </head>
    <body id="page">
	    <nav>
		    <div class="container">
			    <!-- icon -->
			    <a class="brand" href="/" title="Find free food near you"><?php echo e(APP_NAME); ?></a>
				    <ul class="menu">
					    <li>
					    	<a href="/" class="<?php echo e(request()->path() === '/' ? 'active' : ''); ?>" title="Find free food near you">Find Food</a>
					    </li>
					    <li>
					    	<a href="/account" class="<?php echo e(request()->path() === 'account' ? 'active' : ''); ?>" title="Manage your account">Account</a>
					    	<span class="notification-count">3</span>
					    </li>
					    <a href="/share" title="Share your unwanted food">
						    <button class="btn btn-primary">Share Food</button>
						</a>
				    </ul>
			    <!-- hamburger -->
		    </div>
	    </nav>
	    <main class="container-fluid">
	    	<?php echo $__env->yieldContent('content'); ?>
	    </main>
	    <footer>
		    <div class="container">
			    <div class="row">
		            <div class="col-md-4">
		                <h3>Food</h3>
		                <ul class="menu">
		                    <li><a href="/">Home</a></li>
		                    <li><a href="/browse">Browse</a></li>
		                    <li><a href="/share">Add Food</a></li>	                    
		                </ul>
		            </div>
		            <div class="col-md-4">
		                <h3>You</h3>
		                <ul class="menu">
		                    <?php if(Auth::check()): ?>
		                    	<li><a href="/account">Account</a></li>
		                    <?php else: ?>
		                    	<li><a href="/login">Login</a></li>
								<li><a href="/register">Register</a></li>
		                    <?php endif; ?>
		                </ul>
		            </div>
		            <div class="col-md-4">
		                <h3>About Us</h3>
		                <ul class="menu">
			                <li><a href="/contact">Contact Us</a></li>
		                    <li><a href="/cookies">How do we use Cookies?</a> </li>
		                    <li><a href="/privacy">Privacy Policy</a></li>
		                    <li><a href="/about">About Us</a></li>
		                </ul>
		            </div>
			    </div>
		    </div>
	    </footer>
	    
	    <!-- Scripts -->
	    <!-- jQuery --><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	    <!-- Bootstrap --><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	    <script src="/js/scripts.js?v=<?php echo filemtime(public_path('js/scripts.js')); ?>"></script>
	    <!-- GMaps --><script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk6-0ijk4JTLjg5UGFZW3PI-D0GQlmZR8&callback=Harvest.initMap"></script>
    </body>
</html>
