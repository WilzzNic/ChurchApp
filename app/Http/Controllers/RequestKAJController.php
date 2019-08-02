<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\RequestKartuAnggota;
use App\Jemaat;

class RequestKAJController extends Controller
{
    public function index() {
        $jemaat = Jemaat::find(auth()->user()->jemaat->id);
        if($jemaat->requestKAJ) {
            return view('kaj.sent')->with('request', $jemaat->requestKAJ);
        }
        else {
            return view('kaj.request');
        }
    }

    public function request() {
        $requestKAJ = new RequestKartuAnggota();
        $requestKAJ->jemaat_id = auth()->user()->jemaat->id;
        $requestKAJ->status = RequestKartuAnggota::STATUS_PENDING;
        $requestKAJ->save();

        return back();
    }

    public function delete($id) {
        $request = RequestKartuAnggota::find($id);

        $request->status = RequestKartuAnggota::STATUS_CANCELLED;
        $request->save();
        $request->delete();

        return redirect()->back();
    }
}
