<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Message;
use App\Food;

class PageController extends Controller {
	
	private $received;
	private $sent;
	
	public function __construct() {
		$this->middleware('auth', ['only' => [
			'account', 'messages', 'share'
		]]);
	}
	
	public function account() {
		$recentMessages = $this->getReceived()->slice(0,3);
		return view('account')->with(compact('recentMessages'));
	}
	
	public function received() {
		$received = $this->getReceived()->groupBy('from');
		return view('messages')->with(compact('received'));
	}
	
	public function viewReceived(User $from) {
		$received = $this->getReceived()->groupBy('from');
		$conversation = $this->getConversation(Auth::id(), $from->id);
		$food = ($conversation) ? $conversation->first()->food : null;
		
		return view('messages')->with(compact('from', 'received', 'conversation', 'food'));
	}
	
	public function sent() {
		$sent = $this->getSent()->groupBy('to');
		return view('messages')->with(compact('sent'));
	}
	
	public function viewSent(User $to) {
		$sent = $this->getSent()->groupBy('to');
		$conversation = $this->getConversation(Auth::id(), $to->id);
		$food = ($conversation) ? $conversation->first()->food : null;
		
		return view('messages')->with(compact('to', 'sent', 'conversation', 'food'));
	}
	
	public function home() {
		return view('home');
	}
	
	public function browse() {
		return view('browse');
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
	
	private function getConversation($user1_id, $user2_id) {
		return Message::where([
			['from', $user1_id],
			['to', $user2_id]
		])->orWhere([
			['from', $user2_id],
			['to', $user1_id]
		])->orderBy('created_at', 'asc')->get();
	}
	
	private function getReceived() {
		return Message::where('to', Auth::id())->orderBy('created_at', 'desc')->get();
	}
	
	private function getSent() {
		return Message::where('from', Auth::id())->orderBy('created_at', 'desc')->get();
	}
	
}