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
}
