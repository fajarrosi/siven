<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cond extends Model
{
    //
         protected $fillable = [
		'name'
	];	

		public function stok_item()
	{
		return $this->hasMany('App\Stok_item');
	}
}
