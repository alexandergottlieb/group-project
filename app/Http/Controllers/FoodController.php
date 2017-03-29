<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
	
	public function __construct() {
		$this->middleware('auth', ['except' => [
			'index'
		]]);
	}
	
    /**
     * Display a listing of the resource: gets food within a given distance from the requested lat long
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	    if (is_numeric($request->input('latitude')) && is_numeric($request->input('latitude')) && is_numeric($request->input('distance'))) {
		    $foods = Food::where('latitude', '>', $request->input('latitude')-0.1)
		    	->where('latitude', '<', $request->input('latitude')+0.1)
				->where('longitude', '>', $request->input('longitude')-0.1)
		    	->where('longitude', '<', $request->input('longitude')+0.1)
		    	->get();
		    //Filter by distance
		    $userPosition = ['latitude' => $request->input('latitude'), 'longitude' => $request->input('longitude')];
		    $allowedDistance = $request->input('distance') * 1609.34; //Convert to metres
		    $foods = $foods->filter(function($value, $key) use ($userPosition, $allowedDistance) {
			    $foodPosition = ['latitude' => $value->latitude, 'longitude' => $value->longitude];
			    $distance = $this->getDistance($foodPosition, $userPosition);
			    return $distance < $allowedDistance;
		    });
		    return response()->json(array(
			    'data' => array_values($foods->toArray()) //Reset array values to ensure proper serialisation
		    ));
	    } else {
		    return response()->json(array(
			    'error' => 'Missing parameter'
		    ), 400);
	    }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        return response()->json(array(
        	'data' => $food
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
	    	'name' => 'required|max:255',
	    	'image' => 'required|file',
	    	'description' => 'required',
	    	'best_before' => 'required|date',
	    	'longitude' => 'required|numeric',
	    	'latitude' => 'required|numeric',
	    	'category' => Rule::in(Food::$categories)
    	));
    	//Deprecated: Tags validation - array('max:255','regex:/^([a-z])+(,[a-z]+)*$/i')
    	
    	$food = new Food();
    	$food->name = $request->input('name');
    	$food->image = $request->file('image')->store('public/food'); //Store image
    	$food->description = $request->input('description');
    	$food->best_before = $request->input('best_before');
    	$food->longitude = $request->input('longitude');
    	$food->latitude = $request->input('latitude');
    	$food->category = $request->input('category');
    	
    	//Associate with current user
    	$user = Auth::user();
    	$user->foods()->save($food);

    	return redirect('/account'); //Go to account
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {
        $this->validate($request, array(
	    	'name' => 'required|max:255',
	    	'image' => 'file',
	    	'description' => '',
	    	'best_before' => 'date',
	    	'longitude' => 'required|numeric',
	    	'latitude' => 'required|numeric',
	    	'tags' => array('max:255','regex:/^([a-z])+(,[a-z]+)*$/i')
    	));
    	
    	$food->name = $request->input('name');
    	$food->image = $request->file('image')->store('images/food'); //Store image
    	$food->description = $request->input('description');
    	$food->best_before = $request->input('best_before');
    	$food->longitude = $request->input('longitude');
    	$food->latitude = $request->input('latitude');
    	$food->tags = $request->input('tags');
    	
    	$food->save();
    	
    	return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return response()->json(array(
        	'success' => true
        ));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        //
    }
    
    private function rad($x) {
		return $x * pi() / 180;
	}
    private function getDistance($p1, $p2) {
		$R = 6378137; // Earth’s mean radius in meter
		$dlatitude = $this->rad($p2["latitude"] - $p1["latitude"]);
		$dLong = $this->rad($p2["longitude"] - $p1["longitude"]);
		$a = sin($dlatitude / 2) * sin($dlatitude / 2) +
		cos($this->rad($p1["latitude"])) * cos($this->rad($p2["latitude"])) *
		sin($dLong / 2) * sin($dLong / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		$d = $R * $c;
		return $d; // returns the distance in metres
    }
    
}
