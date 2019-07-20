<?php

use Illuminate\Database\Seeder;
use App\Jemaat;
use App\User;

class JemaatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jemaat = new Jemaat();
        $jemaat->user_id = 2;
        $jemaat->nama = 'Wilson Nicholas';
        $jemaat->jenis_kelamin = 'L';
        $jemaat->tempat_lahir = 'Medan';
        $jemaat->tgl_lahir = '1997-07-13';
        $jemaat->no_hp = '081362221023';
        $jemaat->alamat = 'Jl. Kutu No.40';
        $jemaat->status_pernikahan = 'Menikah';
        $jemaat->status = Jemaat::STATUS_UNVERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 3;
        $jemaat->nama = 'Okky Putra Barus';
        $jemaat->jenis_kelamin = 'L';
        $jemaat->tempat_lahir = 'Medan';
        $jemaat->tgl_lahir = '1977-07-10';
        $jemaat->no_hp = '0821712047';
        $jemaat->alamat = 'Jl. Pancing No.90';
        $jemaat->status_pernikahan = 'Belum Menikah';
        $jemaat->status = Jemaat::STATUS_UNVERIFIED;
        $jemaat->save();
    }
}
