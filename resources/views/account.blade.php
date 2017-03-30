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
		            @if(!empty($foods))
		            	<ul class="list-group">
		            	@foreach($foods as $food)
							<li class="food list-group-item media">
						        <a href="/account/food/{{$food->id}}" class="btn big food-edit pull-right"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
						        <button class="btn big food-delete pull-right" data-id="{{ $food->id }}" data-token="{{ csrf_token() }}"><i class="glyphicon glyphicon-remove"></i> Remove</button>
						        <div class="media-left">
						            <a href="/account/food/{{$food->id}}">
						                <figure class="food-image media-object" style="background-image:url('{{ Storage::url($food->image) }}');" alt="{{{ $food->name }}}">
						            </a>
						        </div>
						        <div class="media-body">
						            <a href="/account/food/{{$food->id}}">
						                <h4 class="list-group-item-heading">{{{ $food->name }}}</h4>
						            </a>
						            <p class="food-details"><time class="food-best-before">Best Before: {{ date('jS M Y', $food->best_before->timestamp) }}</time></p>
						            <p class="list-group-item-text">{{{ $food->description }}}</p>
						        </div>
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
		</div>
	</div>
</div>
@endsection