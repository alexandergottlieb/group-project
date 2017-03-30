@extends('master')

@section('title')
Your Food
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<nav>
				<a href="/account">Account</a> <i class="glyphicon glyphicon-menu-right"></i> Food <i class="glyphicon glyphicon-menu-right"></i> {{{ $food->name }}}
			</nav>
			<h1>Your {{{ $food->name }}}</h1>
		</div>
		<div class="col-md-8">
			<ul>
				<li><code>Food</code></li>
				<li><code>Options to delete/edit food</code></li>
				<li><code>MAYBE: Conversations about this food</code></li>
			</ul>
		</div>
	</div>
</div>
@endsection