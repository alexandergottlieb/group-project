<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use App\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
	
	public function __construct() {
		$this->middleware('auth');
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    try {
		    if (empty($request->input('content'))) throw new Exception('missing parameter');
		    $food = Food::findOrFail($request->input('food'));
			$recipient = User::findOrFail($request->input('to'));
	    } catch (Exception $e) {
		    return response()->json([
				'error' => $e->getMessage()
			], 400);
	    }
		
		$message = new Message();
	    $message->from = Auth::id();
	    $message->content = $request->input('content');
	    
		$message->food()->associate($food);
    	$recipient->messages()->save($message);
    	
    	return redirect('/browse');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Food $food)
    {
        return view('messages.create')->with(compact('food'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //TODO authentication - check message is owned by user
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
/*
    public function destroy(Message $message)
    {
        //PROBABLY DON'T NEED THIS
    }
*/
}
