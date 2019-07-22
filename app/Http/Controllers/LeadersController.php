<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Freshbitsweb\Laratables\Laratables;
use App\RequestAltar;
use App\RequestBaptis;
use App\RequestKartuAnggota;
use App\RequestKelasOrientasi;

class LeadersController extends Controller
{
    public function show() {
        $role = auth()->user()->role;

        if($role ==  User::ROLE_L_FA){
            return view('familyaltar.show');
        }
        else if($role ==  User::ROLE_L_BAPTIS) {
            return view('baptis.show');
        }
        else if($role ==  User::ROLE_L_KAJ) {
            return view('kaj.show');
        }
        else {
            return view('kom.show');
        }
    }

    public function showDt() {
        $role = auth()->user()->role;

        if($role ==  User::ROLE_L_FA) {
            return Laratables::recordsOf(RequestAltar::class, function($query) {
                return $query->where('status', RequestAltar::STATUS_PENDING)
                ->whereHas('fa', function($q) {
                    $q->where('owner_id', '=', auth()->user()->jemaat->id);
                });
            });
        }
        else if($role ==  User::ROLE_L_BAPTIS) {
            return Laratables::recordsOf(RequestBaptis::class, function($query) {
                return $query->where('status', RequestBaptis::STATUS_PENDING)
                ->whereHas('jemaat', function($q) {
                    $q->where('lokasi_ibadah', '=', auth()->user()->jemaat->lokasi_ibadah);
                });;
                        
            });
        }
        else if($role ==  User::ROLE_L_KAJ) {
            return Laratables::recordsOf(RequestKartuAnggota::class, function($query) {
                return $query->where('status', RequestKartuAnggota::STATUS_PENDING)
                ->whereHas('jemaat', function($q) {
                    $q->where('lokasi_ibadah', '=', auth()->user()->jemaat->lokasi_ibadah);
                });
            });
        }
        else {
            return Laratables::recordsOf(RequestKelasOrientasi::class, function($query) {
                return $query->where('status', RequestKelasOrientasi::STATUS_PENDING)
                ->whereHas('jemaat', function($q) {
                    $q->whereHas('cabangGereja', function($q) {
                        $q->where('nama_gereja', '=', auth()->user()->cabangGereja);
                    });
                });
            });
        }
    }

    public function approve($id) {
        $role = auth()->user()->role;

        if($role ==  User::ROLE_L_FA) {
            $request = RequestAltar::find($id);
            $request->status = RequestAltar::STATUS_ACCEPTED;
            $request->save();
        }
        else if($role ==  User::ROLE_L_BAPTIS) {
            
        }
        else if($role ==  User::ROLE_L_KAJ) {
            $request = RequestKartuAnggota::find($id);
            $request->status = RequestKartuAnggota::STATUS_ACCEPTED;
            $request->save();
        }
        else {
            
        }

        return back()->withStatus(__('Permohonan telah diterima.'));
    }

    public function reject($id) {
        $role = auth()->user()->role;

        if($role ==  User::ROLE_L_FA){
            $request = RequestAltar::find($id);
            $request->status = RequestAltar::STATUS_REJECTED;
            $request->save();
            $request->delete();
        }
        else if($role ==  User::ROLE_L_BAPTIS) {
            $request = RequestBaptis::find($id);
            $request->status = RequestBaptis::STATUS_REJECTED;
            $request->save();
            $request->delete();
        }
        else if($role ==  User::ROLE_L_KAJ) {
            $request = RequestKartuAnggota::find($id);
            $request->status = RequestKartuAnggota::STATUS_REJECTED;
            $request->save();
            $request->delete();
        }
        else {
            $request = RequestKelasOrientasi::find($id);
            $request->status = RequestKelasOrientasi::STATUS_REJECTED;
            $request->save();
            $request->delete();
        }

        return back()->withStatus(__('Permohonan telah ditolak.'));
    }
}
