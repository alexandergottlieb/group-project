<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller {
	
	public function __construct() {
		$this->middleware('auth', ['only' => [
			'account', 'share'
		]]);
	}
	
	public function home() {
		return view('home');
	}
	
	public function account() {
		//If not logged in
			//Login or register
			//return $this->login();
		//else
		return view('account');
	}
	
	public function share() {
		//If not logged in
			//Login or register
			//return $this->login();
		//else
		return view('share');
	}
	
	public function login() {
		return view('login');
	}
	
	public function contact() {
		return view('contact');
	}
	
}