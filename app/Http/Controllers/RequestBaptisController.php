<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestBaptis;
use App\Jemaat;
use App\CabangGereja;
use App\JadwalBaptisExclude;
use Auth;

class RequestBaptisController extends Controller
{
    public function index() {

        if(auth()->user()->jemaat->requestBaptis) {
            $request = RequestBaptis::where('jemaat_id', auth()->user()->jemaat->id)->first();
            return view('baptis.sent')->with('request', $request);
        }
        else {
            $cab_gerejas = CabangGereja::where('bisa_baptis', true)->get();
            return view('baptis.request')->with('cab_gerejas', $cab_gerejas);
        }
    }

    public function request(Request $request) {
        $validatedData = $request->validate([
            'cabang'  => 'required',
            'tanggal' => 'required|date_format:Y-m-d'
        ]);
        
        $user = Auth::user()->jemaat;
        
        if($user->requestBaptis) {
            $user->requestBaptis->delete();
        }

        $sendRequest = new RequestBaptis();
        $sendRequest->tanggal = $request->tanggal;
        $sendRequest->status = 'Pending';
        $user->requestBaptis()->save($sendRequest);

        return back()->withStatus(__('Permohonan telah dikirim.'));
    }

    public function scheduleExclude(Request $request) {
        $jadwal = JadwalBaptisExclude::where('cabang_gereja_id', $request->cabang)->get();

        return response()->json($jadwal);
    }

    public function delete($id) {
        $jemaat = Auth::user()->jemaat;
        $jemaat->requestBaptis->delete();

        return redirect()->back();
    }
}
