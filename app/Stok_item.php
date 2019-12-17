<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok_item extends Model
{
    //
    public function departement()
    {
        return $this->belongsTo('App\Departement');
    }

        public function Cond()
    {
        return $this->belongsTo('App\Cond');
    }

        public function Item()
    {
        return $this->belongsTo('App\Item');
    }

    protected $fillable = [
        'items_id', 'total'
    ];


}
