<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Rules\ModulKOM;

use App\CabangGereja;
use App\JadwalKOM;
use App\RequestKelasOrientasi;

class RequestKOMController extends Controller
{
    public function index() {
        $requests = RequestKelasOrientasi::where('jemaat_id', auth()->user()->jemaat->id)
                                    ->whereIn('status', [RequestKelasOrientasi::STATUS_ENROLLING, RequestKelasOrientasi::STATUS_PENDING])
                                    ->get();

        if(count($requests) > 0) {
            $request = $requests->sortByDesc('updated_at')
                                ->first();

            return view('kom.sent')->with('request', $request);
        }
        else {
            $cab_gerejas = CabangGereja::get();

            return view('kom.request')->with('cab_gerejas', $cab_gerejas);
        }
    }

    public function schedule(Request $request) {
        $jadwal = JadwalKOM::where('cabang_gereja_id', $request->cabang)
                            ->where('seri_kom', $request->seri);

        return response()->json($jadwal->get());
    }

    public function request(Request $request) {
        Validator::make($request->all(), 
        [
            'cabang' => ['required'],
            'seri' => ['required'],
            'waktu' => ['required', new ModulKOM],
            'asal_gereja'  => ['required'],
            'tanggal' => ['required', 'date_format:Y-m-d'],
        ],
        [
            'seri.required' => 'Seri harus dipilih.',
            'cabang.required' => 'Cabang Gereja harus dipilih.',
            'asal_gereja.required' => 'Asal Gereja harus diisi.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'waktu.required' => 'Waktu harus dipilih.'
        ])->validate();   

        $requestKOM = new RequestKelasOrientasi();
        $requestKOM->jemaat_id = auth()->user()->jemaat->id;
        $requestKOM->jadwal_kom_id = $request->waktu;
        $requestKOM->asal_gereja = $request->asal_gereja;
        $requestKOM->tanggal = $request->tanggal;
        $requestKOM->status = RequestKelasOrientasi::STATUS_PENDING;
        $requestKOM->save();

        return back()->withStatus(__('Permohonan telah dikirim.'));
    }

    public function delete($id) {
        $request = RequestKelasOrientasi::find($id);

        $request->status = RequestKelasOrientasi::STATUS_CANCELLED;
        $request->save();
        $request->delete();

        return redirect()->back();
    }
}
