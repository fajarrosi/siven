<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    //
	protected $fillable = [
		'name'
	];	

	public function user()
	{
		return $this->hasMany('App\User');
	}

	public function stok_item()
	{
		return $this->hasMany('App\Stok_item');
	}

	public function items()
    {
        return $this->belongsToMany(Item::class,'item_departement');
    }

	
}
