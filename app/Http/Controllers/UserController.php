<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Storage;
use App\User;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
	    $user->image = Storage::url($user->image);
        return response()->json(array(
		    'data' => $user
	    ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
	    if (Auth::id() !== $user->id) return back()->with('message', 'Profile was not updated due to an authentication error');
        $this->validate($request, array(
	    	'bio' => 'max:255',
	    	'image' => 'file'
    	));
    	
    	$user->bio = $request->input('bio');
    	if ($request->file('image')) $user->image = $request->file('image')->store('public/users'); //Store image
    	
    	$user->save();
    	
    	return back()->with('message', 'Profile updated');
    }
}
