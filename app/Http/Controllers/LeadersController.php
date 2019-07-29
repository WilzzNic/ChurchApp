<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Jemaat;
use App\RequestAltar;
use App\RequestBaptis;
use App\RequestKartuAnggota;
use App\RequestKelasOrientasi;
use App\CabangGereja;
use App\JadwalKom;

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
                ->whereHas('jadwal', function($q) {
                    $q->where('cabang_gereja_id', '=', auth()->user()->jemaat->lokasi_ibadah);
                });
            });
        }
    }

    public function approve($id) {
        $role = auth()->user()->role;

        if($role == User::ROLE_L_FA) {
            DB::transaction(function () use ($id) {
                $request = RequestAltar::find($id);
                $request->status = RequestAltar::STATUS_ACCEPTED;
                $request->save();

                $jemaat = Jemaat::find($request->jemaat_id);
                $jemaat->family_altar_id = $request->family_altar_id;
                $jemaat->save();
            });
        }
        else if($role == User::ROLE_L_KAJ) {
            $request = RequestKartuAnggota::find($id);
            $request->status = RequestKartuAnggota::STATUS_ACCEPTED;
            $request->save();
        }
        else if($role == User::ROLE_L_KOM) {
            $request = RequestKelasOrientasi::find($id);
            $request->status = RequestKelasOrientasi::STATUS_ACCEPTED;
            $request->save();
        }

        return back()->withStatus(__('Permohonan telah diterima.'));
    }

    public function forBaptis(Request $request) {
        $request_baptis = RequestBaptis::find($request->id);
        $request_baptis->waktu = $request->waktu;
        $request_baptis->status = RequestBaptis::STATUS_ACCEPTED;
        $request_baptis->save();

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
            // $request->save();
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

    public function indexJadwalKOM() {
        return view('kom.add');
    }

    public function dtJadwalKOM() {

        return Laratables::recordsOf(JadwalKom::class, function($query) {
            return $query->where('cabang_gereja_id', auth()->user()->jemaat->lokasi_ibadah);
        });
    }

    public function addJadwalKOM(Request $request) {
        $validator = Validator::make($request->all(), [
            'seri_kom' => [
                'required',
                Rule::unique('jadwal_koms')->where(function($query) use ($request) {
                    return $query->where('waktu', $request->waktu)
                                ->where('hari', $request->hari);
                }),
            ],
            'waktu' => 'required',
            'hari'  => 'required',
        ],
        [
            'seri_kom.required' => 'Seri KOM harus diiisi.',
            'seri_kom.unique' => 'Jadwal ini telah ada di database.',
            'waktu.required' => 'Waktu harus diiisi.',
            'hari.required' => 'Hari KOM harus diiisi.',
        ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $jadwal = new JadwalKom();
        $jadwal->cabang_gereja_id = auth()->user()->jemaat->lokasi_ibadah;
        $jadwal->seri_kom = $request->seri_kom;
        $jadwal->waktu = $request->waktu;
        $jadwal->hari = $request->hari;
        $jadwal->save();

        return back()->withStatus('Jadwal telah ditambahkan ke database.');
    }

    public function deleteJadwalKOM($id) {
        $jadwal = JadwalKom::find($id);
        $jadwal->delete();

        return back()->withStatus('Jadwal telah dihapus.');
    }
}
