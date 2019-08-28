<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalBaptisExclude extends Model
{
    use SoftDeletes;

    public function cabangGereja() {
        return $this->belongsTo('App\CabangGereja');
    }

    public static function laratablesCustomAction($model)
    {
        return view('widgets.baptisleader.crud', compact('model'))->render();
    }
}
