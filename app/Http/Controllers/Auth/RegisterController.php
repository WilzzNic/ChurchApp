<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Jemaat;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required'],
            // 'no_hp' => ['required', 'string'],
            // 'status_nikah' => ['required', 'string'],
            // 'tmpt_lhr' => ['required', 'string'],
            'tgl_lhr' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user_data = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'guest',
        ]);

        $personal_data = new Jemaat();
        $personal_data->user_id = $user_data->id;
        $personal_data->nama = $data['nama'];
        $personal_data->jenis_kelamin = $data['jenis_kelamin'];
        // $personal_data->no_hp = $data['no_hp'];
        // $personal_data->status_pernikahan = $data['status_nikah'];
        // $personal_data->tempat_lahir = $data['tmpt_lhr'];
        $personal_data->tgl_lahir = $data['tgl_lhr'];
        // $personal_data->alamat = $data['alamat'];
        $personal_data->status = 'Unverified';

        $personal_data->save();

        return $user_data;
    }
}
