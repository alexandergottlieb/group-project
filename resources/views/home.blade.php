@extends('master')

@section('content')
<header class="row" style="background-image:url('/images/headers/home.jpg')">
	<div class="col-md-12">
	    <h1>Harvest</h1>
	    <h2>Find food from people nearby.</h2>
	</div>
	<div class="col-md-12 row">
	    <div class="row">
	        <div class="postcode_search form-inline col-md-10 col-md-offset-1">
	            <h3 class = "postcode_search_text"> enter your postcode to search for food near you. </h3>
	        </div>
	        <div class = "col-xs-8 col-xs-offset-2 input-group">
	            <input type="text"
	                   id="postcode_search_input"
	                   class="postcode_search_input form-control"
	                   placeholder="enter postcode"
	                   onchange="validatePostcode()"/>
	            <input type="button" id="postcode_search_submit"
	                   class="glyphicon glyphicon-check btn btn-default postcode_search_submit"
	                   value="search" style="font-family: montserrat_regular"
	                   aria-hidden="true" onclick="postcodeSearch()"/>
	        </div>
	    </div>
	</div>
</header>
@stop
