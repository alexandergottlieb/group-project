@extends('master')

@section('title')
Share
@stop

@section('content')
<div class="row backdrop pad-vertical">
	<div class="col-md-8 col-md-offset-2">
		<form action="/api/foods" method="POST" class="panel panel-default geocode" enctype="multipart/form-data">
            <div class="panel-heading">Share Food</div>
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
	                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
	                <label>Description</label>
	                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
	                <label>Add a picture</label>
	                <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
	                <label>Address</label>
	                <input type="text" name="address" class="geocode-address form-control" value="{{ old('address') }}">
	                <input type="hidden" name="latitude" class="geocode-latitude">
	                <input type="hidden" name="longitude" class="geocode-longitude">
                </div>
                <div class="form-group">
	                <label>Best Before Date</label>
	                <input type="date" name="best_before" class="form-control" value="{{ old('best_before') }}">
	            </div>
	            <div class="form-group">
		            <label>Category</label><br>
		            @foreach (App\Food::$categories as $category)
		            	<label class="radio-inline food-category" style="background-image:url('/images/pins/{{ $category }}.png')">
							<input type="radio" name="category" value="{{ $category }}" @if(old('category') === $category) checked @endif>
							<span class="food-category-name">{{ title_case($category) }}</span>
						</label>
		            @endforeach
	            </div>
            </div>
            <div class="panel-footer alignright">
				<input type="submit" value="Share" class="btn btn-primary">
            </div>
            {{ csrf_field() }}
		</form>
	</div>
</div>
@stop