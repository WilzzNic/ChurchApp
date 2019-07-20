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

    public function populateByDaerah(Request $request) {
        return Laratables::recordsOf(FamilyAltar::class, function($query) use ($request) {
            if($request->daerah == 0) {
                return $query;
            }
            else {
                return $query->whereHas('daerah', function($query) use ($request) {
                    $query->where('id', '=', $request->daerah);
                });
            }
        });
    }

    public function request($id) {
        return $id;
    }
}
