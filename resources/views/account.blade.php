@extends('master')

@section('title')
Account
@stop

@section('content')
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
		            @if(!empty(Auth::user()->foods))
		            	<ul class="list-group">
		            	@foreach(Auth::user()->foods as $food)
			            	<li class="food list-group-item">
				            	<div class="food-details">
					            	<h4 class="list-group-item-heading">{{ $food->name }}</h4>
								    <time class="food-best-before">{{ date('jS M Y', $food->best_before->timestamp) }}</time>
									<p class="list-group-item-text">{{ $food->description }}</p>
				            	</div>
								<figure class="food-image">
									<img src="{{ Storage::url($food->image) }}">
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
					Messages
				</div>
	            <div class="panel-body">
		            @if (isset($messages))
		            	<ul class="list-group">
							@foreach ($messages as $m)
								<a href="/account/messages/{{ $m->id }}">
									<li class="list-group-item">
								    	<h4 class="list-group-item-heading">{{ $m->subject }}</h4>
										<p class="list-group-item-text">{{ substr($m->content, 0, 140) }}...</p>
										<time class="pull-right">{{ $m->created_at }}</time>
									</li>
							    </a>
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
		            <code>Change Password</code>
	            </div>
			</div>
		</div>
	</div>
</div>
@endsection