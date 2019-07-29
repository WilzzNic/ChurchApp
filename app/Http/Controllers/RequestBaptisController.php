<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestBaptis;
use App\Jemaat;
use Auth;

class RequestBaptisController extends Controller
{
    public function index() {
        if(auth()->user()->jemaat->requestBaptis) {
            $request = RequestBaptis::where('jemaat_id', auth()->user()->jemaat->id)->first();
            return view('baptis.sent')->with('request', $request);
        }
        else {
            return view('baptis.request');
        }
    }

    public function request(Request $request) {
        $validatedData = $request->validate([
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

    public function delete($id) {
        $jemaat = Auth::user()->jemaat;
        $jemaat->requestBaptis->delete();

        return redirect()->back();
    }
}
