<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baptis extends Model
{
    const STATUS_VERIFIED = 'Verified';
    const STATUS_UNVERIFIED = 'Unverified';
    const STATUS_INVALID = 'Invalid';

    public function jemaat() {
        return $this->belongsTo('App\Jemaat');
    }

    public static function laratablesCustomAction($model)
    {
        return view('widgets.admin.verifybaptis', compact('model'))->render();
    }
}
