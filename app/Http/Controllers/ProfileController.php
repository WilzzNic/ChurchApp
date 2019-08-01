<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Jemaat;
use App\KAJ;
use App\KOM;
use App\Baptis;
use DB;
use App\CabangGereja;

use App\User;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $jemaat = Jemaat::where('user_id', auth()->user()->id)->first();
        $cabangs = CabangGereja::get();
        
        return view('profile.edit')->with('data', $jemaat)
                                ->with('cabangs', $cabangs);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {

        DB::transaction(function() use ($request) {
            $user = Auth::user();
            if(auth()->user()->role == 'guest' || auth()->user()->role == 'basic_congregation') {
                $user->role = 'basic_congregation';
            }
            $user->save();

            $jemaat = Jemaat::where('user_id', $user->id)->first();
            $jemaat->nama = $request->nama;
            $jemaat->jenis_kelamin = $request->jenis_kelamin;
            $jemaat->no_hp = $request->no_hp;
            $jemaat->alamat = $request->alamat;
            $jemaat->tempat_lahir = $request->tmpt_lhr;
            $jemaat->tgl_lahir = $request->tgl_lhr;
            $jemaat->profesi = $request->profesi;
            $jemaat->status_pernikahan = $request->status_nikah;
            $jemaat->nama_ibu = $request->nama_ibu;
            $jemaat->nama_ayah = $request->nama_ayah;
            $jemaat->lokasi_ibadah = $request->lokasi_ibadah;

            if($request->profesi != null && 
                $request->status_nikah != null &&
                $request->nama_ibu != null &&
                $request->nama_ayah != null &&
                $request->lokasi_ibadah != null) {
                $jemaat->status = Jemaat::STATUS_PENDING;
            }
            else {
                $jemaat->status = Jemaat::STATUS_UNVERIFIED;
            }

            if($request->hasFile('img_kaj')) {
                if($request->img_kaj->isValid()) {
                    $path = $request->img_kaj->store('public/');
                    $jemaat_kaj = KAJ::where('jemaat_id', $jemaat->id)
                                    ->first();
                    if(is_null($jemaat_kaj)) {
                        $jemaat_kaj = new KAJ();
                        $jemaat_kaj->jemaat_id = $jemaat->id;
                    }
                    $jemaat_kaj->img_path = $request->img_kaj->hashName();
                    $jemaat_kaj->status = 'Unverified';
                    $jemaat_kaj->save();
                }
            }

            if($request->hasFile('img_kom_100')) {
                if($request->img_kom_100->isValid()) {
                    $path = $request->img_kom_100->store('public/');
                    $jemaat_kom = KOM::where('jemaat_id', $jemaat->id)
                                    ->where('seri_kom', 100)
                                    ->first();
                    if(is_null($jemaat_kom)) {
                        $jemaat_kom = new KOM();
                        $jemaat_kom->jemaat_id = $jemaat->id;
                    }
                    $jemaat_kom->seri_kom = 100;
                    $jemaat_kom->img_path = $request->img_kom_100->hashName();
                    $jemaat_kom->status = 'Unverified';
                    $jemaat_kom->save();
                }
            }

            if($request->hasFile('img_kom_200')) {
                if($request->img_kom_200->isValid()) {
                    $path = $request->img_kom_200->store('public/');
                    $jemaat_kom = KOM::where('jemaat_id', $jemaat->id)
                                    ->where('seri_kom', 200)
                                    ->first();
                    if(is_null($jemaat_kom)) {
                        $jemaat_kom = new KOM();
                        $jemaat_kom->jemaat_id = $jemaat->id;
                    }
                    $jemaat_kom->seri_kom = 200;
                    $jemaat_kom->img_path = $request->img_kom_200->hashName();
                    $jemaat_kom->status = 'Unverified';
                    $jemaat_kom->save();
                }
            }

            if($request->hasFile('img_kom_300')) {
                if($request->img_kom_300->isValid()) {
                    $path = $request->img_kom_300->store('public/');
                    $jemaat_kom = KOM::where('jemaat_id', $jemaat->id)
                                    ->where('seri_kom', 300)
                                    ->first();
                    if(is_null($jemaat_kom)) {
                        $jemaat_kom = new KOM();
                        $jemaat_kom->jemaat_id = $jemaat->id;
                    }
                    $jemaat_kom->seri_kom = 300;
                    $jemaat_kom->img_path = $request->img_kom_300->hashName();
                    $jemaat_kom->status = 'Unverified';
                    $jemaat_kom->save();
                }
            }

            if($request->hasFile('img_kom_400')) {
                if($request->img_kom_400->isValid()) {
                    $path = $request->img_kom_400->store('public/');
                    $jemaat_kom = KOM::where('jemaat_id', $jemaat->id)
                                    ->where('seri_kom', 400)
                                    ->first();
                    if(is_null($jemaat_kom)) {
                        $jemaat_kom = new KOM();
                        $jemaat_kom->jemaat_id = $jemaat->id;
                    }
                    $jemaat_kom->seri_kom = 400;
                    $jemaat_kom->img_path = $request->img_kom_400->hashName();
                    $jemaat_kom->status = 'Unverified';
                    $jemaat_kom->save();
                }
            }

            if($request->hasFile('img_baptis')) {
                if($request->img_baptis->isValid()) {
                    $path = $request->img_baptis->store('public/');
                    $jemaat_baptis = Baptis::where('jemaat_id', $jemaat->id)->first();
                    if(is_null($jemaat_baptis)) {
                        $jemaat_baptis = new Baptis();
                        $jemaat_baptis->jemaat_id = $jemaat->id;
                    }
                    $jemaat_baptis->img_path = $request->img_baptis->hashName();
                    $jemaat_baptis->status = 'Unverified';
                    $jemaat_baptis->save();
                }
            }

            $user->jemaat()->save($jemaat);
        });

        // auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
