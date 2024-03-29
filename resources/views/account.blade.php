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
		            @if(count($foods) > 0)
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
			@if(count($oldFoods) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						Previously Listed
					</div>
		            <div class="panel-body">
			            	<ul class="list-group">
			            	@foreach($oldFoods as $food)
								<li class="food old list-group-item media">
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
		            </div>
		            <div class="panel-footer alignright">
						<a class="btn btn-primary" href="/share">Add More</a>
		            </div>
				</div>
			@endif
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">Recent Messages</div>
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
				<div class="panel-heading">Your Profile</div>
				<div class="panel-body">
					<div id="userProfile" class="user @if (old('bio') || old('image')) hide @endif">
						@if (!empty(Auth::user()->image))
							<figure class="user-profile-pic" style="background-image:url('{{ Storage::url(Auth::user()->image) }}')"></figure>
						@endif
							<h4>{{{ Auth::user()->name }}}</h4>
							<p>
								@if (!empty(Auth::user()->bio))
									{{{ Auth::user()->bio }}}
								@else
									<em>Why not add a bio?</em>
								@endif
							</p>
					</div>
					<form id="userProfileForm" enctype="multipart/form-data" method="post" action="/api/users/{{ Auth::id() }}/update">
						@if (count($errors))
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
						@endif
						<div class="form-group">
			                <label>Bio</label>
			                <textarea name="bio" class="form-control" maxlength="255">@if (!empty(old('bio'))){{ old('bio') }}@else{{{ Auth::user()->bio }}}@endif</textarea>
		                </div>
		                <div class="form-group">
			                <label>New Profile Picture</label>
			                <input type="file" name="image" class="form-control">
		                </div>
		                {{ csrf_field() }}
					</form>
				</div>
				<div class="panel-footer alignright">
					<button class="btn btn-primary @if (!old('bio') && !old('image')) edit @endif" id="editProfile">Edit</button>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Not {{{Auth::user()->name }}}?</div>
				<div class="panel-body">
					<a href="/auth/logout" class="btn">Logout</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection