<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestKelasOrientasi extends Model
{
    use SoftDeletes;

    const STATUS_PENDING = 'Pending';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_REJECTED = 'Rejected';
    const STATUS_ENROLLING = 'Enrolling';
    const STATUS_CANCELLED = 'Cancelled';

    public function jemaat() {
        return $this->belongsTo('App\Jemaat');
    }

    public function jadwal() {
        return $this->belongsTo('App\JadwalKom', 'jadwal_kom_id');
    }

    public static function laratablesCustomAction($model)
    {
        return view('widgets.approvalbuttons', compact('model'))->render();
    }

    public static function laratablesCustomEmail($model)
    {
        return $model->jemaat->user->email;
    }

    public static function laratablesCustomComplete($model)
    {
        return view('widgets.komleader.complete', compact('model'))->render();
    }
}
