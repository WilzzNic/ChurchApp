<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;

use App\FamilyAltar;
use App\Jemaat;
use App\Daerah;
use App\User;
use App\Baptis;
use App\KOM;
use App\KAJ;
use DB;

class ManageFAController extends Controller
{
    public function index() {
        $jemaats = Jemaat::doesntHave('ownerFamilyAltar')
                        ->where('lokasi_ibadah', auth()->user()->jemaat->lokasi_ibadah)
                        ->whereHas('user', function($query) {
                            $query->where('role', '=', 'basic_congregation')
                                ->orWhere('role', '=', 'expert_congregation');
                        })
                        ->get();

        $daerahs = Daerah::get();

        return view('admin.familyaltar.index')->with('jemaats', $jemaats)
                                            ->with('daerahs', $daerahs);
    }

    public function dtAltar() {
        return Laratables::recordsOf(FamilyAltar::class, function($query) {
            return $query->whereHas('owner', function($q) {
                $q->where('lokasi_ibadah', '=', auth()->user()->jemaat->lokasi_ibadah);
            });
        });
    }

    public function add(Request $request) {
        DB::transaction(function () use ($request) {
            $family_altar = new FamilyAltar();
            $family_altar->owner_id = $request->jemaat;
            $family_altar->daerah_id = $request->daerah;
            $family_altar->FA_number = $request->no_fa;
            $family_altar->alamat = $request->alamat;
            $family_altar->hari = $request->hari;
            $family_altar->waktu = $request->waktu;
            $family_altar->save();
            
            $user = User::find($family_altar->owner->user->id);
            $user->role = User::ROLE_L_FA;
            $user->save();

            $jemaat = Jemaat::where('user_id', $user->id)->first();
            $jemaat->family_altar_id = $family_altar->id;
            $jemaat->save();
        });

        return back()->withStatus('Family Altar telah didaftarkan.');
    }

    public function edit($id) {
        $family_altar = FamilyAltar::find($id);
        $daerahs = Daerah::get();

        return view('admin.familyaltar.edit')->with('family_altar', $family_altar)
                                ->with('daerahs', $daerahs);
    }

    public function update(Request $request, $id) {
        $family_altar = FamilyAltar::find($id);
        $family_altar->owner_id = $request->jemaat_id;
        $family_altar->daerah_id = $request->daerah;
        $family_altar->FA_number = $request->no_fa;
        $family_altar->alamat = $request->alamat;
        $family_altar->hari = $request->hari;
        $family_altar->waktu = $request->waktu;
        $family_altar->save();

        return redirect()->route('admin.manage.fa.index')->withStatus('Family Altar telah terupdate.');
    }

    public function delete($id) {
        DB::transaction(function () use ($request) {
            $family_altar = FamilyAltar::find($id);
            $family_altar->delete();

            if($user->jemaat->status == Jemaat::STATUS_VERIFIED && 
            $user->jemaat->baptis->status == Baptis::STATUS_VERIFIED &&
            $user->jemaat->kaj->status == KAJ::STATUS_VERIFIED &&
            $user->jemaat->kom->status == KOM::STATUS_VERIFIED) {
                $user = User::find($family_altar->owner->user->id);
                $user->role = User::ROLE_E_CON;
                $user->save();
            }
            else {
                $user = User::find($family_altar->owner->user->id);
                $user->role = User::ROLE_B_CON;
                $user->save();
            }
            
            $jemaat = Jemaat::where('user_id', $user->id)->first();
            $jemaat->family_altar_id = null;
            $jemaat->save();
        });

        return back()->withStatus('Family Altar telah dibubarkan.');
    }
}
