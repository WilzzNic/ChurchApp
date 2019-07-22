<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestBaptis extends Model
{
    const STATUS_PENDING = 'Pending';
    const STATUS_ACCEPTED = 'Accepted';
    const STATUS_REJECTED = 'Rejected';

    public function jemaat() {
        return $this->belongsTo('App\Jemaat');
    }

    public static function laratablesCustomAction($model)
    {
        return view('widgets.baptisleader.approvalbuttons', compact('model'))->render();
    }
}
