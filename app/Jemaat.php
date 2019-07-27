<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    const STATUS_VERIFIED = 'Verified';
    const STATUS_UNVERIFIED = 'Unverified';
    const STATUS_PENDING = 'Pending Verification';
    const STATUS_INVALID = 'Invalid';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function kaj() {
        return $this->hasOne('App\KAJ');
    }

    public function kom() {
        return $this->hasOne('App\KOM');
    }

    public function baptis() {
        return $this->hasOne('App\Baptis');
    }

    public function fa() {
        return $this->belongsTo('App\FamilyAltar', 'family_altar_id');
    }

    public function ownerFamilyAltar() {
        return $this->hasOne('App\FamilyAltar', 'owner_id');
    }

    public function requestBaptis() {
        return $this->hasOne('App\RequestBaptis');
    }

    public function requestAltar() {
        return $this->hasOne('App\RequestAltar');
    }

    public function requestKAJ() {
        return $this->hasOne('App\RequestKartuAnggota');
    }

    public function cabangGereja() {
        return $this->belongsTo('App\CabangGereja', 'lokasi_ibadah');
    }

    public static function laratablesCustomAction($model)
    {
        return view('widgets.admin.verifyjemaat', compact('model'))->render();
    }
}
