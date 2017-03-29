@extends('master')

@section('title')
Account
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<nav>
				<a href="/account">Account</a>
			</nav>
		</div>
		<div class="col-md-12">
			<h1>Welcome back, {{{ Auth::user()->name }}}</h1>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Your Food
				</div>
	            <div class="panel-body">
		            @if(!empty(Auth::user()->foods))
		            	<ul class="list-group">
		            	@foreach(Auth::user()->foods as $food)
			            	<li class="food list-group-item">
				            	<div class="food-details">
					            	<h4 class="list-group-item-heading">{{{ $food->name }}}</h4>
								    <time class="food-best-before">{{ date('jS M', $food->best_before->timestamp) }}</time>
									<p class="list-group-item-text">{{{ $food->description }}}</p>
				            	</div>
								<figure class="food-image">
									<img src="{{ Storage::url($food->image) }}" alt="{{{ $food->name }}}">
								</figure>
							</li>
		            	@endforeach
		            @else
		            	<p>You have not added any food, let's <a href="/share">share</a> now!</p>
		            @endif
	            </div>
	            <div class="panel-footer alignright">
					<a class="btn btn-primary" href="/share">Add More</a>
	            </div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					Recent Messages
				</div>
	            <div class="panel-body">
		            @if (isset($recentMessages))
		            	<ul class="list-group">
							@foreach ($recentMessages as $m)
								<li class="list-group-item">
									<time class="pull-right">{{ date('jS M H:s', $m->created_at->timestamp) }}</time>
							    	<a href="/account/messages/received/{{ $m->from }}"><h4 class="list-group-item-heading">{{{ App\User::find($m->from)->name }}}</h4></a>
									<p class="list-group-item-text">{{{ substr($m->content, 0, 140) }}}...</p>
								</li>
							@endforeach
						</ul>
					@else
						<p>You have no messages yet.</p>
		            @endif
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
		            <code>Profile pic</code>
		            <code>Change Password</code>
	            </div>
			</div>
		</div>
	</div>
</div>
@endsection