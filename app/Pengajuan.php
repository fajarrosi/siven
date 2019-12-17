<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    //
     protected $fillable = [
        'user_id', 'item_id', 'total'
    ];
        public function persetujuan()
    {
        return $this->hasOne('App\Persetujuan','pngjuan_id');
    }
}
