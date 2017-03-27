@extends('master')

@section('title')
Share
@stop

@section('content')
<div class="row backdrop">
	<div class="col-md-8 col-md-offset-2">
		<form action="/foods" class="panel panel-default geocode">
            <div class="panel-heading">Share Food</div>
            <div class="panel-body">
                {{ method_field('POST') }}
                <div class="form-group">
	                <label>Name</label>
	                <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
	                <label>Description</label>
	                <textarea name="description" class="form-control" required></textarea>
                </div>
                <div class="form-group">
	                <label>Add a picture</label>
	                <input type="file" name="name" class="form-control">
                </div>
                <div class="form-group">
	                <label>Address</label>
	                <input type="text" class="geocode-address form-control" required>
	                <input type="hidden" name="latitude" class="geocode-latitude">
	                <input type="hidden" name="longitude" class="geocode-longitude">
                </div>
                <div class="form-group">
	                <label>Date</label>
	                <input type="date" name="best_before" class="form-control" required>
	            </div>
	            <div class="form-group">
		            <label>Category</label><br>
		            <label class="radio-inline">
						<input type="radio" name="category" value="meat">Fruit
					</label>
		            <label class="radio-inline">
						<input type="radio" name="category" value="meat">Vegetable
					</label>
		            <label class="radio-inline">
						<input type="radio" name="category" value="meat">Meat
					</label>
					<label class="radio-inline">
						<input type="radio" name="category" value="meat">Dairy
					</label>
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