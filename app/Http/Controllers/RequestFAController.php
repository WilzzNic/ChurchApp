<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\FamilyAltar;
use App\Daerah;
use App\RequestAltar;

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
                return $query->where('owner_id', '!=', auth()->user()->jemaat->id);
            }
            else {
                return $query->where('owner_id', '!=', auth()->user()->jemaat->id)
                            ->whereHas('daerah', function($query) use ($request) {
                    $query->where('id', '=', $request->daerah);
                });
            }
        });
    }

    public function request($id) {
        $jemaat = auth()->user()->jemaat;

        $request_altar = new RequestAltar();
        $request_altar->jemaat_id = $jemaat->id;
        $request_altar->family_altar_id = $id;
        $request_altar->status = RequestAltar::STATUS_PENDING;
        $request_altar->save();

        return back()->withStatus(__('Permohonan telah dikirim.'));
    }

    public function leave($id) {
        $request_altar = RequestAltar::find($id);
        $request_altar->delete();
        
        return back()->withStatus(__('Anda telah keluar dari Family Altar.'));
    }
}
