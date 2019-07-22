<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestKelasOrientasi extends Model
{
    use SoftDeletes;

    const STATUS_PENDING = 'Pending';
    const STATUS_ACCEPTED = 'Accepted';
    const STATUS_REJECTED = 'Rejected';

    public function jemaat() {
        return $this->belongsTo('App\Jemaat');
    }

    public function jadwal() {
        return $this->belongsTo('App\JadwalKom');
    }

    public static function laratablesCustomAction($model)
    {
        return view('widgets.approvalbuttons', compact('model'))->render();
    }
}
