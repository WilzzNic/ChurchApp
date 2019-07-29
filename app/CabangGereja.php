<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CabangGereja extends Model
{
    use SoftDeletes;

    public function jemaat() {
        return $this->belongsToMany('App\Jemaat');
    }

    public static function laratablesCustomAction($model)
    {
        return view('widgets.superadmin.cabanggereja.crud', compact('model'))->render();
    }
}
