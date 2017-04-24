<div class="media user-profile">
	<div class="media-left"><img src="@if(!empty($user->image)){{ Storage::url($user->image) }}@endif"></div>
	<div class="media-body">
		<h4>{{{ $user->name }}</h4>
		<p>@if(!empty($user->bio)){{{ $user->bio }}}@endif</p>
	</div>
</div>