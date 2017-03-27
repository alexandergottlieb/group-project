@extends('master')

@section('content')
<header class="row" style="background-image:url('/images/headers/home.jpg')">
	<div class="col-md-12">
	    <h1>Harvest</h1>
	    <h2>Find food from people nearby</h2>
	</div>
	<div class="col-md-4 col-md-offset-4">
        <input type="text" id="locationSearch" class="postcode_search_input form-control" placeholder="Enter Postcode">
	</div>
</header>
@stop
