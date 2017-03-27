@extends('master')

@section('title')
Account
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Your Food
				</div>
	            <div class="panel-body">
		            
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
									<li class="list-group-item @if($m->id === $message->id) active @endif">
								    	<h4 class="list-group-item-heading">{{ $m->subject }}</h4>
										<p class="list-group-item-text">{{ substr($m->content, 0, 140) }}...</p>
										<time class="pull-right">{{ $m->created_at }}</time>
									</li>
							    </a>
							@endforeach
						</ul>
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