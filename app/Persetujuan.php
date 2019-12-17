<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persetujuan extends Model
{
    use SoftDeletes;
     protected $fillable = [
        'stat_id', 'user_id', 'pngjuan_id'
    ];
    protected $dates = ['deleted_at'];

        public function pengajuan()
    {
        return $this->belongsTo('App\Pengajuan');
    }
            public function stat()
    {
        return $this->belongsTo('App\Stat');
    }
}
