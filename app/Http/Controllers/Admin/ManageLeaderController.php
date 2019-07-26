<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

use App\Rules\RolePimpinan;
use App\User;
use App\Jemaat;

class ManageLeaderController extends Controller
{
    public function index() {
        return view('admin.pimpinan.index');
    }

    public function dt() {
        return Laratables::recordsOf(User::class, function($query) {
            return $query
                ->whereIn('role', [User::ROLE_L_KAJ, User::ROLE_L_FA, User::ROLE_L_KOM, User::ROLE_L_BAPTIS])
                ->whereHas('jemaat', function($q) {
                    $q->where('lokasi_ibadah', '=', auth()->user()->jemaat->lokasi_ibadah);
                });
        });
    }

    public function add(Request $request) {
        Validator::make($request->all(), 
        [
            'email' => ['required', 'unique:users,email'],
            'nama'  => ['required', 'min:3'],
            'jenis_kelamin' => ['required'],
            'tgl_lhr' => ['required', 'date_format:Y-m-d'],
            'role' => [
                'required', 
                new RolePimpinan,
            ],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
        ],
        [
            'email.required'    => 'Data e-mail harus diisi.',
            'email.unique'      => 'E-mail ini sudah digunakan pengguna lain.',
            'nama.required'     => 'Data nama harus diisi.',
            'role.required'     => 'Kategori pimpinan harus dipilih.',
            'password.required' => 'Kata Sandi harus dimasukkan.',
            'password.confirmed'=> 'Konfirmasi Kata Sandi tidak sama.',
        ])->validate();    

        DB::transaction(function() use ($request){
            $user = new User();
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = $request->role;
            $user->save();

            $jemaat = new Jemaat();
            $jemaat->user_id = $user->id;
            $jemaat->nama = $request->nama;
            $jemaat->jenis_kelamin = $request->jenis_kelamin;
            $jemaat->tgl_lahir = $request->tgl_lhr;
            $jemaat->lokasi_ibadah = auth()->user()->jemaat->lokasi_ibadah;
            $jemaat->status = Jemaat::STATUS_VERIFIED;
            $jemaat->save();
        });

        return back()->withStatus('Pimpinan baru telah diregistrasi.');
    }

    public function delete($id) {
        DB::transaction(function() use ($id) {
            $user = User::find($id);
            $user->jemaat()->delete();
            $user->delete();
        });
        
        return back()->withErrors(['msg' => 'Pimpinan telah dihapus.']);
    }
}
