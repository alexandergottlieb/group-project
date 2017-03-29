@extends('master')

@section('title')
Account
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<nav>
				<a href="/account">Account</a> <i class="glyphicon glyphicon-menu-right"></i> Messages
			</nav>
		</div>
		<div class="col-md-12">
			<h1>Messages</h1>
		</div>
		<div class="col-md-2">
			<ul class="list-group">
				<a href="/account/messages">
					<li class="list-group-item">Inbox</li>
				</a>
				<a href="/account/messages/sent">
					<li class="list-group-item">Sent</li>
				</a>
			</ul>
		</div>
		<div class="col-md-4">
			<ul class="list-group">
				@if (isset($received))
					@foreach ($received as $from_id => $messages)
						<?php
							$latestMessage = $messages[0];
							$food = $latestMessage->food;
							$fromUser = App\User::find($from_id);
						?>
						<a href="/account/messages/received/{{ $fromUser->id }}">
							<li class="list-group-item @if(isset($from) && $fromUser->id == $from->id) active @endif">
								<time class="pull-right">{{ date('jS M H:s', $latestMessage->created_at->timestamp) }}</time>
								<h4 class="list-group-item-heading">{{{ $fromUser->name }}}</h4>
								<p>I'd like to pick up your {{{ strtolower($food->name) }}}</p>
							</li>
						</a>
					@endforeach
				@elseif (isset($sent))
					@foreach ($sent as $to_id => $messages)
						<?php
							$latestMessage = $messages[0];
							$food = $latestMessage->food;
							$toUser = App\User::find($to_id);
						?>
						<a href="/account/messages/sent/{{ $toUser->id }}">
							<li class="list-group-item @if(isset($to) && $toUser->id == $to->id) active @endif">
								<time class="pull-right">{{ date('jS M H:s', $latestMessage->created_at->timestamp) }}</time>
								<h4 class="list-group-item-heading">{{{ $toUser->name }}}</h4>
								<p>I'd like to pick up your {{{ strtolower($food->name) }}}</p>
							</li>
						</a>
					@endforeach
				@endif
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<?php //if (isset($conversation)) var_dump($conversation->toArray()); ?>
				@if (isset($conversation))
					<?php $otherUser = isset($from) ? $from : $to; ?>
					<div class="panel-heading">
						{{{ $otherUser->name }}}
					</div>
					<div id="messages" class="panel-body">
						@foreach ($conversation as $message)
							<div class="speech-bubble clearfix @if($message->from == Auth::id()) sent @else received @endif">
								<p>
									{{{ $message->display() }}}
								</p>
								<time class="pull-right">{{ date('jS M H:s', $message->created_at->timestamp) }}</time>
							</div>
						@endforeach
					</div>
					<div class="panel-footer">
			            <form action="/messages"  method="post">
				            <div class="form-group">
					            <textarea name="content" class="form-control" placeholder="Reply"></textarea>						
				            </div>
				            <div class="alignright">
					            <input type="submit" class="btn btn-primary" value="Send">
				            </div>
				            <input type="hidden" name="food" value="{{ $food->id }}">
				            <input type="hidden" name="to" value="{{ $otherUser->id }}">
				            {{ csrf_field() }}
		            	</form>
		            </div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection