<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\Validator;

use App\CabangGereja;

class CabangGerejaController extends Controller
{
    public function index() {
        return view('superadmin.cabanggereja.index');
    }

    public function dt() {
        return Laratables::recordsOf(CabangGereja::class);
    }

    public function add(Request $request) {
        Validator::make($request->all(), 
        [
            'cabang' => ['required', 'unique:cabang_gerejas,nama_gereja'],
        ],
        [
            'cabang.required'    => 'Nama Cabang Gereja harus diisi.',
            'cabang.unique'      => 'Cabang ini telah terdaftar di database.',
        ])->validate();

        $cabang = new CabangGereja();
        $cabang->nama_gereja = $request->cabang;
        if($request->has('check_baptis')) {
            $cabang->bisa_baptis = $request->check_baptis;
        }
        else {
            $cabang->bisa_baptis = false;
        }
        $cabang->save();

        return back()->withStatus('Cabang berhasil ditambahkan.');
    }

    public function delete($id) {
        $cabang = CabangGereja::find($id);
        $cabang->delete();

        return back()->withStatus('Cabang Gereja telah dihapus.');
    }
}
