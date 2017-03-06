@extends('master')

@section('content')
<header class="row" style="background-image:url('/images/headers/home.jpg')">
	<div class="col-md-12">
	    <h1>Harvest</h1>
	    <h2>Find food from people nearby</h2>
	</div>
	<div class="col-md-12 row">
	    <div class="row">
	        <div class = "col-xs-8 col-xs-offset-2 input-group">
	            <input type="text" id="postcode_search" class="postcode_search_input form-control" placeholder="Enter Postcode">
	        </div>
	    </div>
	</div>
</header>
@stop
