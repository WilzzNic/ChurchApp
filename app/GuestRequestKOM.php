<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestRequestKOM extends Model
{
    use SoftDeletes;

    const STATUS_PENDING = 'Pending';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_REJECTED = 'Rejected';
    const STATUS_ENROLLING = 'Enrolling';
    const STATUS_CANCELLED = 'Cancelled';

    public function guest() {
        return $this->belongsTo('App\Guest', 'guest_id');
    }

    public function jadwal() {
        return $this->belongsTo('App\JadwalKom', 'jadwal_kom_id');
    }

    public static function laratablesCustomCabang($model)
    {
        return $model->jadwal->cabangGereja->nama_gereja;
    }

    public static function laratablesCustomApproval($model)
    {
        return view('widgets.komleader.approvalguest', compact('model'))->render();
    }

    public static function laratablesCustomComplete($model)
    {
        return view('widgets.komleader.completeguest', compact('model'))->render();
    }
}
