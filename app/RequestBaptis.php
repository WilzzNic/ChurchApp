<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestBaptis extends Model
{
    use SoftDeletes;

    const STATUS_PENDING = 'Pending';
    const STATUS_ACCEPTED = 'Accepted';
    const STATUS_REJECTED = 'Rejected';

    public function jemaat() {
        return $this->belongsTo('App\Jemaat');
    }

    public function cabangGereja() {
        return $this->belongsTo('App\CabangGereja');
    }

    public static function laratablesCustomAction($model)
    {
        return view('widgets.baptisleader.approvalbuttons', compact('model'))->render();
    }
    
    public static function laratablesCustomEmail($model)
    {
        return $model->jemaat->user->email;
    }
}
