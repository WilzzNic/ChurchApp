<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestKartuAnggota extends Model
{
    use SoftDeletes;

    const STATUS_PENDING = 'Pending';
    const STATUS_ACCEPTED = 'Accepted';
    const STATUS_REJECTED = 'Rejected';

    public function jemaat() {
        return $this->belongsTo('App\Jemaat');
    }

    public static function laratablesCustomAction($model)
    {
        return view('widgets.approvalbuttons', compact('model'))->render();
    }
}
