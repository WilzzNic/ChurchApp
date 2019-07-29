<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\Validator;
use DB;

use App\User;
use App\CabangGereja;
use App\Jemaat;

class ManageAdminController extends Controller
{
    public function index() {
        $users = User::where('role', User::ROLE_ADMIN)->with('jemaat')->get()
                        ->pluck('jemaat.lokasi_ibadah')->toArray();
                        
        $cabangs = CabangGereja::whereNotIn('id', $users)->get();

        return view('superadmin.admin.index')->with('cabangs', $cabangs);
    }

    public function dt() {
        return Laratables::recordsOf(User::class, function($query) {
            return $query->where('role', 'admin');
        });
    }

    public function add(Request $request) {
        Validator::make($request->all(), 
        [
            'cabang' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'nama'  => ['required', 'min:3'],
            'jenis_kelamin' => ['required'],
            'tgl_lhr' => ['required', 'date_format:Y-m-d'],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
        ],
        [
            'cabang.required'   => 'Cabang harus dipilih.',
            'email.required'    => 'Data e-mail harus diisi.',
            'email.unique'      => 'E-mail ini sudah digunakan pengguna lain.',
            'nama.required'     => 'Data nama harus diisi.',
            'password.required' => 'Kata Sandi harus dimasukkan.',
            'password.confirmed'=> 'Konfirmasi Kata Sandi tidak sama.',
        ])->validate(); 

        DB::transaction(function() use ($request){
            $user = new User();
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = User::ROLE_ADMIN;
            $user->save();

            $jemaat = new Jemaat();
            $jemaat->user_id = $user->id;
            $jemaat->nama = $request->nama;
            $jemaat->jenis_kelamin = $request->jenis_kelamin;
            $jemaat->tgl_lahir = $request->tgl_lhr;
            $jemaat->lokasi_ibadah = $request->cabang;
            $jemaat->status = Jemaat::STATUS_VERIFIED;
            $jemaat->save();
        });
        
        return back()->withStatus('Admin baru telah diregistrasi.');
    }

    public function delete($id) {
        DB::transaction(function() use ($id) {
            $user = User::find($id);
            $user->jemaat()->delete();
            $user->delete();
        });
        
        return back()->withErrors(['msg' => 'Admin telah dihapus.']);
    }
}
