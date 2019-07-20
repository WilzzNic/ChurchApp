<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyAltar extends Model
{
    public function owner() {
        return $this->belongsTo('App\Jemaat', 'owner_id');
    }

    public function daerah() {
        return $this->belongsTo('App\Daerah');
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\FamilyAltar
     * @return string
     */
    public static function laratablesCustomAction($family_altar)
    {
        return view('widgets.farequestbutton', compact('family_altar'))->render();
    }
}
