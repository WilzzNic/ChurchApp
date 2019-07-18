<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\FamilyAltar;
use App\Daerah;

class RequestFAController extends Controller
{
    public function index() {
        $daerahs = Daerah::get();
        return view('familyaltar.request')->with('daerahs', $daerahs);
    }

    public function populateFA() {
        return Laratables::recordsOf(FamilyAltar::class);
    }
}
