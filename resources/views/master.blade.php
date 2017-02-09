<?php
	define('APP_NAME', 'Harvest');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
        	@hasSection('title')
            	@yield('title') | {{ APP_NAME }}
			@else
            	{{ APP_NAME }}
			@endif
        </title>
		
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
        
		<!-- Styles -->
		<link rel="stylesheet" href="/css/style.css?v=<?php echo filemtime(public_path('css/style.css')); ?>">
		
    </head>
    <body>
	    <header>
		    <div class="container">
			    <!-- icon -->
			    <a href="/" title="Find free food near you">
				    <h1>{{ APP_NAME }}</h1>
			    </a>
			    <nav>
				    <ul class="menu">
					    <li>
					    	<a href="/" class="{{ request()->path() === '/' ? 'active' : '' }}" title="Find free food near you">Browse</a>
					    </li>
					    <li>
					    	<a href="/account" class="{{ request()->path() === 'account' ? 'active' : '' }}" title="Manage your account">Account</a>
					    	<span class="notification-count">3</span>
					    </li>
				    </ul>
				    <a href="/share" title="Share your unwanted food">
					    <button class="primary">Share Your Food</button>
					</a>
			    </nav>
			    <!-- hamburger -->
		    </div>
	    </header>
	    <main>
	    	@yield('content')
	    </main>
	    <footer>
		    
		    <!-- Scripts -->
	    </footer>
	    <!-- TODO if new visitor -->
	    <div id="bottom-bar">
		    <div class="container">
		    	<small>In order to function, we use cookies. By using this site you are giving implied consent to the use use of cookies.</small>
		    	<button class="primary">Okay</button>
		    	<a href="/cookie-policy" title="Cookie Policy">
			    	<button class="secondary">Find Out More</button>
		    	</a>
		    </div>
	    </div>
	    <!-- else -->
    </body>
</html>
