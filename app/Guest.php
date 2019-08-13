<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public function requestKOM() {
        return $this->hasMany('App\GuestRequestKOM', 'guest_id');
    }
}
