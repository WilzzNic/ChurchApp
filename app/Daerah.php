<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Daerah extends Model
{
    use SoftDeletes;

    public static function laratablesCustomAction($daerah)
    {
        return view('widgets.superadmin.daerah.crud', compact('daerah'))->render();
    }
}
