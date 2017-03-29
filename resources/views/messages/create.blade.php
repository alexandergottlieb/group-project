<form action="/messages" method="post" class="row">
	<div class="col-md-10">
		<h4>Hi, {{{ $food->user->name }}}</h4>
	</div>
	<div class="col-md-2">
		<img src="{{ Storage::url($food->image) }}" alt="{{{ $food->name }}}">
	</div>
	<div class="col-md-12 pad-top">
	    <div class="form-group">
	       	<textarea name="content" class="form-control">I'd like to pick up your food, when is a good time to meet?</textarea>
	    </div>
	</div>
	<div class="col-md-12">
       	<input type="submit" value="Send" class="btn btn-primary pull-right">
	</div>
	<input type="hidden" name="food" value="{{ $food->id }}">
	<input type="hidden" name="to" value="{{ $food->user->id }}">
	{{ csrf_field() }}
</form>