@extends('master')

@section('title')
Find Food
@stop

@section('content')
<div class="row">
    <div class="col-xs-12 col-md-7" id="itemsContainer">
        <div class="row filters">
            <div class="col-xs-12 col-md-3">
	            <div class="input-group add-on col-xs-12">
	                <input class="form-control" id="locationSearchInput" placeholder="Where Are You?" type="text">
	                <div class="input-group-btn">
	                    <button class="btn btn-default" id="locationSearchButton"><i class="glyphicon glyphicon-search"></i></button>
	                </div>
	            </div>
            </div>
            <div class="dropdown col-xs-12 col-md-3">
                <button class="btn btn-default btn-block dropdown-toggle" id="distanceFilterValue" type="button" data-toggle="dropdown">Distance: 2 miles <span class="caret"></span></button>
                <ul class="dropdown-menu distanceDropdown">
                    <li><input type="range" name="distanceFilter" id="distanceFilter" value="2" min="1" max="10"></li>
                </ul>
            </div>
            <div class="col-xs-12 col-md-3">
                <select class="form-control" id="expirationFilter">
                    <option selected value="">Expires After</option>
                    <option value="">-</option>
                    <option value="{{ Carbon::tomorrow() }}">Today</option>
                    <option value="{{ Carbon::tomorrow()->addDay(1) }}">Tomorrow</option>
                    <option value="{{ Carbon::today()->addWeek(1) }}">A Week</option>
                    <option value="{{ Carbon::today()->addWeek(4) }}">A month</option>
                </select>
            </div>
            <div class="col-xs-12 col-md-3">
                <select class="form-control" id="typeFilter">
	                <option selected value="">Category</option>
	                <option value="">-</option>
	                @foreach (App\Food::$categories as $category)
	                	<option value="{{ $category }}">{{ title_case($category) }}</option>
	                @endforeach
                </select>
            </div>
        </div>
        
        <hr>
        
        <div class="row filters">
            <div class="col-xs-6"><h1 class="nomargin text-center">Find Food</h1></div>
            <div class="col-xs-6">
                <select class="form-control" id="sortBy">
                    <option selected value="1">Ascending</option>
                    <option value="2">Descending</option>
                    <option value="3">Distance</option>
                    <option value="4">Expiry Date (Shortest)</option>
                    <option value="5">Expiry Date (Longest)</option>
                </select>
            </div>
        </div>

        <div class="row" id="itemsList"></div>
    </div>

    <div class="col-xs-12 col-md-5 hidden-xs" id="map"></div>
</div>
@stop