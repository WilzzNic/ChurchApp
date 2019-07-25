<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalKom extends Model
{
    use SoftDeletes;

    public function cabangGereja() {
        return $this->belongsTo('App\CabangGereja');
    }
}
