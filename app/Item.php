<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    	protected $fillable = [
		'name'
	];	

		public function stok_item()
	{
		return $this->hasMany('App\Stok_item');
	}

	    public function departements()
    {
        return $this->belongsToMany(Departement::class,'item_departement');
    }
}
