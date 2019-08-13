<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;

use App\CabangGereja;
use App\JadwalKOM;
use App\GuestRequestKOM;
use App\Guest;


class RequestKOMController extends Controller
{
    public function index() {
        $cab_gerejas = CabangGereja::get();

        return view('guest.index')->with('cab_gerejas', $cab_gerejas);
    }

    public function schedule(Request $request) {
        $jadwal = JadwalKOM::where('cabang_gereja_id', $request->cabang)
                            ->where('seri_kom', $request->seri);

        return response()->json($jadwal->get());
    }

    public function request(Request $request) {
        Validator::make($request->all(), 
        [
            'nama' => ['required', 'min:3'],
            'jenis_kelamin' => ['required'],
            'no_hp' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'tmpt_lhr' => ['required', 'string'],
            'tgl_lhr' => ['required', 'date'],
            'asal_gereja'  => ['required'],
            'email' => ['required'],
            'cabang' => ['required'],
            'seri' => ['required'],
            'waktu' => ['required'],
            'tanggal' => ['required', 'date_format:Y-m-d'],
        ],
        [
            'nama.required' => 'Nama harus diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin harus dipilih.',
            'no_hp.required' => 'No. HP harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'tmpt_lhr.required' => 'Tempat Lahir harus diisi.',
            'tgl_lhr.required' => 'Tanggal Lahir harus diisi',
            'asal_gereja.required' => 'Asal Gereja harus diisi.',
            'email.required' => 'Email harus diisi.',
            'cabang.required' => 'Cabang Gereja harus dipilih.',
            'seri.required' => 'Seri harus dipilih.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'waktu.required' => 'Waktu harus dipilih.'
        ])->validate();
        
        DB::transaction(function() use ($request) {
            $guest = new Guest();
            $guest->nama = $request->nama;
            $guest->jenis_kelamin = $request->jenis_kelamin;
            $guest->email = $request->email;
            $guest->no_hp = $request->no_hp;
            $guest->alamat = $request->alamat;
            $guest->tempat_lahir = $request->tmpt_lhr;
            $guest->tgl_lahir = $request->tgl_lhr;
            $guest->asal_gereja = $request->asal_gereja;
            $guest->email = $request->email;
            $guest->save();

            $requestKOM = new GuestRequestKOM();
            $requestKOM->guest_id = $guest->id;
            $requestKOM->jadwal_kom_id = $request->waktu;
            $requestKOM->tanggal = $request->tanggal;
            $requestKOM->status = GuestRequestKOM::STATUS_PENDING;
            $requestKOM->save();
        });

        return back()->withStatus(__('Permohonan telah dikirim.'));
    }
}
