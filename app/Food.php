<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
	//Deleted food stays in database - https://laravel.com/docs/5.4/eloquent#soft-deleting
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    
}
