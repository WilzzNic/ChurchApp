<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    public function kaj() {
        return $this->hasOne('App\KAJ');
    }

    public function kom() {
        return $this->hasOne('App\KOM');
    }

    public function fa() {
        return $this->belongsTo('App\FamilyAltar', 'family_altar_id');
    }

    public function requestBaptis() {
        return $this->hasOne('App\RequestBaptis');
    }
}
