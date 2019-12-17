<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    //
    protected $fillable = [
        'user_id', 'item_id', 'kode_item','cond_id'
    ];
}
