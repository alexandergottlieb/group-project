<?php $__env->startSection('title'); ?>
Find Food
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                <button class="btn btn-default btn-block dropdown-toggle" id="distanceFilterValue" type="button" data-toggle="dropdown">Distance: 5 miles <span class="caret"></span></button>
                <ul class="dropdown-menu distanceDropdown">
                    <li><input type="range" name="distanceFilter" id="distanceFilter" value="5" min="1" max="10"></li>
                </ul>
            </div>
            <div class="col-xs-12 col-md-3">
                <select class="form-control" id="expirationFilter">
                    <option selected value="0">Expiration Date</option>
                    <option value="1">Today</option>
                    <option value="2">Tomorrow or Earlier</option>
                    <option value="3">A Week or Earlier</option>
                    <option value="4">Over a Week</option>
                </select>
            </div>
            <div class="col-xs-12 col-md-3">
                <select class="form-control" id="typeFilter">
                    <option selected value="0">Food Type</option>
                    <option value="1">Meat and Fish</option>
                    <option value="2">Fruit and Veg</option>
                    <option value="3">Tinned Food</option>
                    <option value="4">Drinks</option>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>