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
			<ul class="list-group">
				<li class="food list-group-item media">
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
		    </ul>
		    <form action="/foods/edit/{{$food->id}}" method="post" class="panel panel-default" enctype="multipart/form-data">
	            <div class="panel-heading">Edit</div>
	            <div class="panel-body">
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
		                <label>Item Name</label>
		                <input type="text" name="name" class="form-control" value="{{ $food->name }}">
	                </div>
	                <div class="form-group">
		                <label>Description</label>
		                <textarea name="description" class="form-control">{{ $food->description }}</textarea>
	                </div>
	                <div class="form-group">
		                <label>Change picture</label>
		                <input type="file" name="image" class="form-control">
	                </div>
	                <div class="form-group">
		                <label>Best Before Date</label>
		                <input type="date" name="best_before" class="form-control" value="{{ Carbon::parse($food->best_before)->toDateString() }}">
		            </div>
		            <div class="form-group">
			            <label>Category</label><br>
			            @foreach (App\Food::$categories as $category)
			            	<label class="radio-inline food-category" style="background-image:url('/images/pins/{{ $category }}.png')">
								<input type="radio" name="category" value="{{ $category }}" @if($food->category === $category) checked @endif>
								<span class="food-category-name">{{ title_case($category) }}</span>
							</label>
			            @endforeach
		            </div>
	            </div>
	            <div class="panel-footer alignright">
					<input type="submit" value="Update" class="btn btn-primary">
	            </div>
	            {{ csrf_field() }}
			</form>
		</div>
	</div>
</div>
@endsection