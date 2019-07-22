<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestKartuAnggota;

class RequestKAJController extends Controller
{
    public function index() {
        return view('kaj.request');
    }

    public function request() {
        $requestKAJ = new RequestKartuAnggota();
        $requestKAJ->jemaat_id = auth()->user()->jemaat->id;
        $requestKAJ->status = RequestKartuAnggota::STATUS_PENDING;
        $requestKAJ->save();

        return back();
    }
}
