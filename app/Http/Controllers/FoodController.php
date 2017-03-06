<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return response()->json(array(
        	'data' => Food::orderBy('created_at', 'desc')->limit(10)->get()
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
	    	'name' => 'required|max:255',
	    	'image' => 'file',
	    	'description' => '',
	    	'best_before' => 'date',
	    	'longitude' => 'required|numeric',
	    	'latitude' => 'required|numeric',
	    	'tags' => array('max:255','regex:/^([a-z])+(,[a-z]+)*$/i')
    	));
    	
    	$food = new Food();
    	$food->name = $request->input('name');
    	$food->image = $request->file('image')->store('images/food'); //Store image
    	$food->description = $request->input('description');
    	$food->best_before = $request->input('best_before');
    	$food->longitude = $request->input('longitude');
    	$food->latitude = $request->input('latitude');
    	$food->tags = $request->input('tags');
    	
    	$food->save();

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
}
