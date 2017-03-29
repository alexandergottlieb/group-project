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
							<li class="list-group-item @if(isset($message)) @if($m->id === $message->id) active @endif @endif">
								<time class="pull-right">{{ date('jS M Y', $m->created_at->timestamp) }}</time>
						    	<h4 class="list-group-item-heading">{{{ App\User::find($m->from)->name }}}</h4>
								<p class="list-group-item-text">{{ substr($m->content, 0, 140) }}...</p>
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
						{{{ App\User::find($m->from)->name }}}
						<time class="pull-right">{{ date('jS M Y', $message->created_at->timestamp) }}</time>
					</div>
		            <div class="panel-body">
			            <p>{{{ $message->content }}}</p>
			            <code>Going to need to loop all messages with the same food id to form conversation</code>
		            </div>
		            <div class="panel-footer">
			            <form action="/messages"  method="post">
				            <div class="form-group">
					            <textarea name="message" class="form-control" placeholder="Reply"></textarea>
					            <input type="hidden" name="to" value="{{ $message->from }}">							
				            </div>
				            <div class="alignright">
					            <input type="submit" class="btn btn-primary" value="Send">
				            </div>
				            {{ csrf_field() }}
		            	</form>
		            </div>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection