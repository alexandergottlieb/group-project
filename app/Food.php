<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
	use SoftDeletes; //Deleted food stays in database - https://laravel.com/docs/5.4/eloquent#soft-deleting
	
	protected $dates = [
		'created_at',
        'updated_at',
        'deleted_at',
        'best_before'
    ];
    
    protected $dateFormat = 'M j Y';
	
	public static $categories = [
		'fruit', 'vegetable', 'meat', 'dairy'
	];
	
	public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
