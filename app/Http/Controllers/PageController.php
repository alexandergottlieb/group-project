<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
		$food = []; //TODO get user's food,
		$messages = []; //TODO get user's messages, limit to 5 most recent
		return view('account')->with(compact('food', 'messages'));
	}
	
	public function message(Message $message) {
		//TODO check message belongs to current user
		if (!$message->read) {
			$message->read = true;
			$message->save();
		}
		$messages = []; //TODO get user's messages
		return view('messages')->with(compact('message', 'messages'));	
	}
	
	public function messages() {
		return view('messages');
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