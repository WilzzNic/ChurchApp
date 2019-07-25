<?php

use Illuminate\Database\Seeder;
use App\JadwalKOM;

class JadwalKOMsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jadwal = new JadwalKOM();
        $jadwal->cabang_gereja_id = 1;
        $jadwal->seri_kom = 300;
        $jadwal->hari = 'Selasa';
        $jadwal->waktu = '18:00:00';
        $jadwal->save();

        $jadwal = new JadwalKOM();
        $jadwal->cabang_gereja_id = 1;
        $jadwal->seri_kom = 100;
        $jadwal->hari = 'Selasa';
        $jadwal->waktu = '09:00:00';
        $jadwal->save();

        $jadwal = new JadwalKOM();
        $jadwal->cabang_gereja_id = 1;
        $jadwal->seri_kom = 300;
        $jadwal->hari = 'Minggu';
        $jadwal->waktu = '20:00:00';
        $jadwal->save();
    }
}
