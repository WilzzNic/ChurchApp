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
        $jemaat->family_altar_id = 1;
        $jemaat->jenis_kelamin = 'L';
        $jemaat->tempat_lahir = 'Medan';
        $jemaat->tgl_lahir = '1997-07-13';
        $jemaat->no_hp = '081362221023';
        $jemaat->alamat = 'Jl. Kutu No.40';
        $jemaat->lokasi_ibadah = 1;
        $jemaat->status_pernikahan = 'Menikah';
        $jemaat->status = Jemaat::STATUS_UNVERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 3;
        $jemaat->nama = 'Halo';
        $jemaat->family_altar_id = 2;
        $jemaat->jenis_kelamin = 'L';
        $jemaat->tempat_lahir = 'Medan';
        $jemaat->tgl_lahir = '1977-07-10';
        $jemaat->no_hp = '0821712047';
        $jemaat->lokasi_ibadah = 1;
        $jemaat->alamat = 'Jl. Pancing No.90';
        $jemaat->status_pernikahan = 'Belum Menikah';
        $jemaat->status = Jemaat::STATUS_UNVERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 4;
        $jemaat->nama = 'Andi';
        $jemaat->jenis_kelamin = 'L';
        $jemaat->tempat_lahir = 'Medan';
        $jemaat->tgl_lahir = '1987-12-17';
        $jemaat->no_hp = '0127471248';
        $jemaat->alamat = 'Jl. Kecoa No.90';
        $jemaat->lokasi_ibadah = 1;
        $jemaat->status_pernikahan = 'Belum Menikah';
        $jemaat->status = Jemaat::STATUS_UNVERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 5;
        $jemaat->nama = 'Budi';
        $jemaat->jenis_kelamin = 'L';
        $jemaat->tempat_lahir = 'Medan';
        $jemaat->tgl_lahir = '1987-12-17';
        $jemaat->no_hp = '0127471248';
        $jemaat->alamat = 'Jl. Kecoa No.91';
        $jemaat->status_pernikahan = 'Cerai/Pisah';
        $jemaat->lokasi_ibadah = 2;
        $jemaat->status = Jemaat::STATUS_UNVERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 6;
        $jemaat->nama = 'Emily';
        $jemaat->jenis_kelamin = 'P';
        $jemaat->tempat_lahir = 'Medan';
        $jemaat->tgl_lahir = '1987-12-17';
        $jemaat->no_hp = '01274121248';
        $jemaat->alamat = 'Jl. Kecoa No.91';
        $jemaat->status_pernikahan = 'Belum Menikah';
        $jemaat->lokasi_ibadah = 1;
        $jemaat->status = Jemaat::STATUS_UNVERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 7;
        $jemaat->nama = 'Ceci';
        $jemaat->jenis_kelamin = 'P';
        $jemaat->tempat_lahir = 'Medan';
        $jemaat->tgl_lahir = '1987-12-17';
        $jemaat->no_hp = '012741223';
        $jemaat->alamat = 'Jl. Kecoa No.91';
        $jemaat->status_pernikahan = 'Janda/Duda';
        $jemaat->lokasi_ibadah = 1;
        $jemaat->status = Jemaat::STATUS_UNVERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 1;
        $jemaat->nama = 'Argon';
        $jemaat->jenis_kelamin = 'L';
        $jemaat->tempat_lahir = 'Medan';
        $jemaat->tgl_lahir = '1990-09-30';
        $jemaat->no_hp = '01274122312';
        $jemaat->alamat = 'Jl. Argon No.1';
        $jemaat->status_pernikahan = 'Belum Menikah';
        $jemaat->lokasi_ibadah = 1;
        $jemaat->status = Jemaat::STATUS_VERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 8;
        $jemaat->nama = 'SuperAdmin';
        $jemaat->jenis_kelamin = 'L';
        $jemaat->tempat_lahir = 'Medan';
        $jemaat->tgl_lahir = '1987-12-17';
        $jemaat->no_hp = '012741223';
        $jemaat->alamat = 'Jl. Thamrin No.91';
        $jemaat->status_pernikahan = 'Janda/Duda';
        $jemaat->status = Jemaat::STATUS_VERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 9;
        $jemaat->nama = 'Wilson Kho';
        $jemaat->jenis_kelamin = 'L';
        $jemaat->tempat_lahir = 'Medan';
        $jemaat->tgl_lahir = '1997-07-13';
        $jemaat->no_hp = '08136221023';
        $jemaat->alamat = 'Jl. Kadal No.91';
        $jemaat->status_pernikahan = 'Belum Menikah';
        $jemaat->status = Jemaat::STATUS_UNVERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 10;
        $jemaat->nama = 'Judy';
        $jemaat->jenis_kelamin = 'P';
        $jemaat->tempat_lahir = 'Medan';
        $jemaat->tgl_lahir = '1997-07-13';
        $jemaat->no_hp = '08136221023';
        $jemaat->alamat = 'Jl. Kadal No.91';
        $jemaat->lokasi_ibadah = 2;
        $jemaat->status_pernikahan = 'Janda/Duda';
        $jemaat->status = Jemaat::STATUS_VERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 11;
        $jemaat->nama = 'Erik Justian';
        $jemaat->jenis_kelamin = 'L';
        $jemaat->tempat_lahir = 'Jakarta';
        $jemaat->tgl_lahir = '1997-12-04';
        $jemaat->no_hp = '0899999112';
        $jemaat->alamat = 'Jl. Gardenia No.91';
        $jemaat->lokasi_ibadah = 1;
        $jemaat->status_pernikahan = 'Cerai/Pisah';
        $jemaat->status = Jemaat::STATUS_VERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 12;
        $jemaat->nama = 'Dicky Tan';
        $jemaat->jenis_kelamin = 'L';
        $jemaat->tempat_lahir = 'Surabaya';
        $jemaat->tgl_lahir = '1997-02-27';
        $jemaat->no_hp = '08134322432';
        $jemaat->alamat = 'Jl. Jamin Ginting No.4';
        $jemaat->lokasi_ibadah = 2;
        $jemaat->status_pernikahan = 'Belum Menikah';
        $jemaat->status = Jemaat::STATUS_UNVERIFIED;
        $jemaat->save();

        $jemaat = new Jemaat();
        $jemaat->user_id = 13;
        $jemaat->nama = 'Calvin Orliando';
        $jemaat->jenis_kelamin = 'L';
        $jemaat->tempat_lahir = 'Papua';
        $jemaat->tgl_lahir = '1997-09-21';
        $jemaat->no_hp = '08134322432';
        $jemaat->alamat = 'Jl. Siak No.4';
        $jemaat->lokasi_ibadah = 1;
        $jemaat->status_pernikahan = 'Belum Menikah';
        $jemaat->status = Jemaat::STATUS_UNVERIFIED;
        $jemaat->save();
    }
}
