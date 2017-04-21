@extends('master')

@section('title')
Find Food
@stop

@section('content')
<div class="row filters">
    <div class="col-xs-12 col-md-2 col-md-offset-1">
	    <label>Search</label>
        <div class="input-group add-on">
            <input class="form-control" id="locationSearchInput" placeholder="Where Are You?" type="text">
            <div class="input-group-btn">
                <button class="btn btn-default" id="locationSearchButton"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
    </div>
    <div class="dropdown col-xs-12 col-md-2">
	    <label>Within</label>
        <button class="btn btn-default btn-block dropdown-toggle" id="distanceFilterValue" type="button" data-toggle="dropdown">2 miles <span class="caret"></span></button>
        <ul class="dropdown-menu distanceDropdown">
            <li><input type="range" name="distanceFilter" id="distanceFilter" value="2" min="1" max="10"></li>
        </ul>
    </div>
    <div class="col-xs-12 col-md-2">
	    <label>Expires</label>
        <select class="form-control" id="expirationFilter">
            <option value="" selected>-</option>
            <option value="{{ Carbon::tomorrow() }}">Today</option>
            <option value="{{ Carbon::tomorrow()->addDay(1) }}">Tomorrow</option>
            <option value="{{ Carbon::today()->addWeek(1) }}">A Week</option>
            <option value="{{ Carbon::today()->addWeek(4) }}">A month</option>
        </select>
    </div>
    <div class="col-xs-12 col-md-2">
	    <label>Category</label>
        <select class="form-control" id="typeFilter">
            <option value="" selected>-</option>
            @foreach (App\Food::$categories as $category)
            	<option value="{{ $category }}">{{ title_case($category) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
	    <label>Sort by</label>
	    <select class="form-control" id="sortBy">
		    <option value="best_before" selected>Best Before</option>
            <option value="distance">Distance</option>
            <option value="name">Name</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-7" id="itemsContainer">
        <ul class="list-grup" id="itemsList">
        </ul>
    </div>
    <div class="col-xs-12 col-md-5 hidden-xs" id="map"></div>
</div>
@stop