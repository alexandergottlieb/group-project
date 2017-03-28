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
            	Eat Just
			<?php endif; ?>
        </title>
		
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
        
		<!-- Styles -->
		<link rel="stylesheet" href="/css/style.css?v=<?php echo filemtime(public_path('css/style.css')); ?>">
		
    </head>
    <body>
	    <header>
		    <!-- icon -->
		    <h1><?php echo e(APP_NAME); ?></h1>
		    <nav>
			    <ul class="menu">
				    <li><a href="/" title="Find unwanted food near you">Browse</a></li>
				    <li><a href="/account" title="Manage your account">Account</a></li>
				    <li><a class="button" href="/share" title="Share your unwanted food">Share Your Food</a></li>
			    </ul>
		    </nav>
		    <!-- hamburger -->
	    </header>
	    <main>
	    	<?php echo $__env->yieldContent('content'); ?>
	    </main>
	    <footer>
		    
		    <!-- Scripts -->
	    </footer>
    </body>
</html>
