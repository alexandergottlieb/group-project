@extends('master')

@section('title')
Account
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h1>Messages</h1>
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
				<p>You have not received any messages yet! :(</p>
			@endif
		</div>
		<div class="col-md-4">
			@if(isset($message))
				<div class="panel panel-default">
					<div class="panel-heading">
						{{ $message->subject }}
						<time class="pull-right">{{ $message->created_at }}</time>
					</div>
		            <div class="panel-body">
			            {{ $message->content }}
		            </div>
		            <form class="panel-footer form-horizontal">
			            {{ method_field('POST') }}
			            <div class="form-group">
				            <textarea name="message" class="form-control" placeholder="Reply"></textarea>
				            <input type="hidden" name="to" value="{{ $message->from }}">
							<a class="btn btn-primary" href="/account/messages">Send</a>
			            </div>
			            {{ csrf_field() }}
		            </form>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection