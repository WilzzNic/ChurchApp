<?php

namespace App\Http\Controllers\LeaderBaptis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\JadwalBaptisExclude;

class ManageJadwalController extends Controller
{
    /**
     * Manajemen Jadwal Baptis Index
     * 
     * Display index page of Manajemen Jadwal Baptis
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        return view('baptis.jadwal');
    }

    /**
     * Datatable of Manajemen Jadwal Baptis
     * 
     * Display data of excluded date to table
     *
     * @return \Freshbitsweb\Laratables\Laratables
     */
    public function dt() {
        return Laratables::recordsOf(JadwalBaptisExclude::class, function($query) {
            return $query->where('cabang_gereja_id', auth()->user()->jemaat->lokasi_ibadah);
        });
    }

    /**
     * Add Jadwal Baptis
     * 
     * Add new excluded Jadwal Baptis to database
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function add(Request $request) {
        Validator::make($request->all(), 
        [
            'tanggal' => [
                'required',
                Rule::unique('jadwal_baptis_excludes')->where(function($query) {
                    return $query->where('cabang_gereja_id', auth()->user()->jemaat->lokasi_ibadah);
                }),
            ],
        ],
        [
            'tanggal.required' => 'Tanggal harus dipilih.',
            'tanggal.unique' => 'Jadwal ini telah ada di database.',
        ],
        )->validate();

        $jadwal = new JadwalBaptisExclude();
        $jadwal->cabang_gereja_id = auth()->user()->jemaat->lokasi_ibadah;
        $jadwal->tanggal = $request->tanggal;
        $jadwal->save();

        return back()->withStatus('Jadwal telah ditambahkan ke database');
    }

    /**
     * Delete Jadwal Baptis
     * 
     * Delete excluded Jadwal Baptis from database
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function delete($id) {
        $jadwal = JadwalBaptisExclude::find($id);
        $jadwal->delete();

        return back()->withStatus('Jadwal telah dihapus.');
    }
}
