<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;

use App\Daerah;

class DaerahController extends Controller
{
    public function index() {
        return view('superadmin.daerah.index');
    }

    public function dt() {
        return Laratables::recordsOf(Daerah::class);
    }

    public function add(Request $request) {
        $daerah = new Daerah();
        $daerah->nama_daerah = $request->nama_daerah;
        $daerah->save();

        return back()->withStatus('Daerah telah ditambah.');
    }

    public function delete($id) {
        $daerah = Daerah::find($id);
        $daerah->delete();

        return back()->withStatus('Daerah telah dihapus.');
    }
}
