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
    const STATUS_CANCELLED = 'Cancelled';

    public function jemaat() {
        return $this->belongsTo('App\Jemaat');
    }

    public static function laratablesCustomAction($model)
    {
        return view('widgets.approvalbuttons', compact('model'))->render();
    }

    public static function laratablesCustomEmail($model)
    {
        return $model->jemaat->user->email;
    }

    public static function laratablesCustomCabang($model)
    {
        return $model->jemaat->cabangGereja->nama_gereja;
    }
}
