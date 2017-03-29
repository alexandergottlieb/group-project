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
				<li><code>Conversations about this food</code></li>
			</ul>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					Messages
				</div>
	            <div class="panel-body">
		            @if (isset($conversations))
						<ul class="list-group">
							@foreach ($conversations as $from_id => $messages)
								<?php
									$from = App\User::find($from_id);
									$recentMessage = $messages[0];
								?>
								<a href="/account/messages">
									<li class="list-group-item">
										<time class="pull-right">{{ date('jS M H:s', $recentMessage->created_at->timestamp) }}</time>
								    	<h4 class="list-group-item-heading">{{{ $from->name }}}</h4>
										<p class="list-group-item-text">{{ substr($recentMessage->content, 0, 140) }}...</p>
									</li>
							    </a>
							@endforeach
						</ul>
					@else
						<p>You have not received any messages yet! :(</p>
					@endif
	            </div>
	            <div class="panel-footer">
		            
	            </div>
			</div>
		</div>
	</div>
</div>
@endsection