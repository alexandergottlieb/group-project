<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
	public function display() {
		if (!$this->read && Auth::id() == $this->to) {
			$this->read = true;
			$this->save();
		}
		return $this->content;
	}
	
    public function users() {
        return $this->belongsToMany('App\User');
    }
    
    public function food() {
        return $this->belongsTo('App\Food');
    }
}
