<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Storage;

class FoodController extends Controller
{
	
	public function __construct() {
		$this->middleware('auth', ['except' => [
			'index', 'show'
		]]);
	}
	
    /**
     * Display a listing of the resource: gets food within a given distance from the requested lat long
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	    $this->validate($request, array(
	    	'latitude' => 'required|numeric',
	    	'longitude' => 'required|numeric',
	    	'category' => Rule::in(Food::$categories),
	    	'best_before' => 'date'
    	));
    	
	    $foods = Food::where('latitude', '>', $request->input('latitude')-0.1)
	    	->where('latitude', '<', $request->input('latitude')+0.1)
			->where('longitude', '>', $request->input('longitude')-0.1)
	    	->where('longitude', '<', $request->input('longitude')+0.1);
	    
	    if (!empty($request->input('category'))) $foods = $foods->where('category', $request->input('category'));
	    if (!empty($request->input('best_before'))) {
		    $best_before = date('Y-m-d H:i:s', strtotime($request->input('best_before')));
		    $foods = $foods->whereDate('best_before', '>', $best_before);
		}
	    
	    $foods = $foods->orderBy('created_at', 'desc')->get();
	    
	    //Filter by distance
	    $userPosition = ['latitude' => $request->input('latitude'), 'longitude' => $request->input('longitude')];
	    $allowedDistance = $request->input('distance') * 1609.34; //Convert to metres
	    $foods = $foods->filter(function($value, $key) use ($userPosition, $allowedDistance) {
		    $foodPosition = ['latitude' => $value->latitude, 'longitude' => $value->longitude];
		    $distance = $this->getDistance($foodPosition, $userPosition);
		    return $distance < $allowedDistance;
	    });
	    
	    foreach ($foods as $food) {
		    $food->user = $food->user;
		    $food->image = Storage::url($food->image);
	    }
	    return response()->json(array(
		    'data' => array_values($foods->toArray()) //Reset array values to ensure proper serialisation
	    ));
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
	    	'name' => 'required|max:40',
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
	    	'name' => 'required|max:40',
	    	'image' => 'file',
	    	'description' => 'required',
	    	'best_before' => 'required|date',
	    	'category' => Rule::in(Food::$categories)
    	));
    	
    	$food->name = $request->input('name');
    	if ($request->file('image')) $food->image = $request->file('image')->store('public/food'); //Store image
    	$food->description = $request->input('description');
    	$food->best_before = $request->input('best_before');
    	$food->category = $request->input('category');
    	
    	$food->save();
    	
    	return back()->with('message', 'Food updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
	    if ($food->user->id != Auth::id()) abort('403'); //Foods can only be deleted by their owners
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
