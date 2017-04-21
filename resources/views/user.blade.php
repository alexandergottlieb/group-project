<div class="media user-profile">
	<div class="media-left"><img src="{{ Storage::url($user->image) }}"></div>
	<div class="media-body">
		<h4>{{{ $user->name }}</h4>
		<p>{{{ $user->bio }}}</p>
	</div>
</div>