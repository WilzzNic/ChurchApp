<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CabangGereja;
use App\JadwalKOM;
use App\RequestKelasOrientasi;

class RequestKOMController extends Controller
{
    public function index() {
        $cab_gerejas = CabangGereja::get();

        return view('kom.request')->with('cab_gerejas', $cab_gerejas);
    }

    public function schedule(Request $request) {
        $jadwal = JadwalKOM::where('cabang_gereja_id', $request->cabang)
                            ->where('seri_kom', $request->seri);

        return response()->json($jadwal->get());
    }

    public function request(Request $request) {
        $requestKOM = new RequestKelasOrientasi();
        $requestKOM->jemaat_id = auth()->user()->jemaat->id;
        $requestKOM->jadwal_kom_id = $request->waktu;
        $requestKOM->asal_gereja = $request->asal_gereja;
        $requestKOM->tanggal = $request->tanggal;
        $requestKOM->status = RequestKelasOrientasi::STATUS_PENDING;
        $requestKOM->save();

        return back()->withStatus(__('Permohonan telah dikirim.'));
    }
}
