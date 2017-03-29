<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	
	public function display() {
		$this->read = true;
		?>
		
		<?php
	}
	
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function food() {
        return $this->belongsTo('App\Food');
    }
}
