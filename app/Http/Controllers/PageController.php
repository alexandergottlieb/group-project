<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Message;

class PageController extends Controller {
	
	public function __construct() {
		$this->middleware('auth', ['only' => [
			'account', 'messages', 'share'
		]]);
	}
	
	public function home() {
		return view('home');
	}
	
	public function browse() {
		return view('browse');
	}
	
	public function account() {
		$food = Auth::user()->food;
		$messages = Auth::user()->messages;
		return view('account')->with(compact('food', 'messages'));
	}
	
	public function message(Message $message) {
		if (Auth::user()->messages->contains($message->id)) { //Check message belongs to current user
			if (!$message->read) {
				$message->read = true;
				$message->save();
			}
			$messages = Auth::user()->messages;
			return view('messages')->with(compact('message', 'messages'));	
		} else {
			return response('Access denied. Are you logged in?', 403);
		}
	}
	
	public function messages() {
		$messages = Auth::user()->messages;
		return view('messages')->with(compact('messages'));
	}
	
	public function share() {
		return view('share');
	}
	
	public function about() {
		return view('about.about');
	}
	
	public function contact() {
		return view('about.contact');
	}
	
	public function cookies() {
		return view('about.cookies');
	}
	
	public function privacy() {
		return view('about.privacy');
	}
	
}