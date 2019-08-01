<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;

use App\Baptis;
use App\KOM;
use App\KAJ;
use App\Jemaat;
use DB;

class DataVerificationController extends Controller
{
    public function indexBaptis() {
        $baptis = Baptis::find(1);

        return view('admin.verifikasi.baptis');
    }

    public function indexKom() {
        return view('admin.verifikasi.kom');
    }

    public function indexKaj() {
        return view('admin.verifikasi.kaj');
    }

    public function indexJemaat() {
        return view('admin.verifikasi.jemaat');
    }

    public function dtBaptis() {
        return Laratables::recordsOf(Baptis::class, function($query) {
            return $query->where('status', '=', Baptis::STATUS_UNVERIFIED)
                ->whereHas('jemaat', function($q) {
                    $q->where('lokasi_ibadah', '=', auth()->user()->jemaat->lokasi_ibadah);
                 });
        });
    }

    public function dtKom() {
        return Laratables::recordsOf(KOM::class, function($query) {
            return $query->where('status', '=', KOM::STATUS_UNVERIFIED)
            ->whereHas('jemaat', function($q) {
                $q->where('lokasi_ibadah', '=', auth()->user()->jemaat->lokasi_ibadah);
            });
        });
    }

    public function dtKaj() {
        return Laratables::recordsOf(KAJ::class, function($query) {
            return $query->where('status', '=', KAJ::STATUS_UNVERIFIED)
            ->whereHas('jemaat', function($q) {
                $q->where('lokasi_ibadah', '=', auth()->user()->jemaat->lokasi_ibadah);
            });
        });
    }

    public function dtJemaat() {
        return Laratables::recordsOf(Jemaat::class, function($query) {
            return $query->where('status', '=', Jemaat::STATUS_PENDING)
            ->where('lokasi_ibadah', '=', auth()->user()->jemaat->lokasi_ibadah);
        });
    }

    public function imgBaptis($id) {
        $baptis = Baptis::find($id);

        return view('admin.verifikasi.imgcore')->with('data', $baptis);
    }

    public function imgKom($id) {
        $kom = KOM::find($id);

        return view('admin.verifikasi.imgcore')->with('data', $kom);
    }

    public function imgKaj($id) {
        $kaj = KAJ::find($id);

        return view('admin.verifikasi.imgcore')->with('data', $kaj);
    }

    public function validateBaptis($id) {
        $baptis = Baptis::find($id);
        $baptis->status = Baptis::STATUS_VERIFIED;
        $baptis->save();

        return back()->withStatus('Sertifikat terverifikasi');
    }

    public function validateKom($id) {
        $kom = KOM::find($id);
        $kom->status = KOM::STATUS_VERIFIED;
        $kom->save();

        return back()->withStatus('Sertifikat terverifikasi');
    }

    public function validateKaj($id) {
        $kaj = KAJ::find($id);
        $kaj->status = KAJ::STATUS_VERIFIED;
        $kaj->save();

        return back()->withStatus('KAJ terverifikasi');
    }

    public function validateJemaat($id) {
        DB::transaction(function() use ($id){
            $jemaat = Jemaat::find($id);
            $jemaat->status = Jemaat::STATUS_VERIFIED;
            // $jemaat->user->role = Jemaat::ROLE_E_CON;
            $jemaat->push();
        });

        return back()->withStatus('Jemaat terverifikasi');
    }

    public function invalidateBaptis($id) {
        $baptis = Baptis::find($id);
        $baptis->status = Baptis::STATUS_INVALID;
        $baptis->save();

        return back()->withStatus('Sertifikat telah ditolak');
    }

    public function invalidateKom($id) {
        $kom = KOM::find($id);
        $kom->status = KOM::STATUS_INVALID;
        $kom->save();

        return back()->withStatus('Sertifikat telah ditolak');
    }

    public function invalidateKaj($id) {
        $kaj = KAJ::find($id);
        $kaj->status = KAJ::STATUS_INVALID;
        $kaj->save();

        return back()->withStatus('Sertifikat telah ditolak');
    }

    public function invalidateJemaat($id) {
        $jemaat = Jemaat::find($id);
        $jemaat->status = Jemaat::STATUS_INVALID;
        $jemaat->save();

        return back()->withStatus('Data Jemaat telah ditolak');
    }
}
