<?php

use Illuminate\Database\Seeder;
use App\CabangGereja;

class CabangGerejasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cab_gereja = new CabangGereja();
        $cab_gereja->nama_gereja = 'GBI Medan Plaza';
        $cab_gereja->save();

        $cab_gereja = new CabangGereja();
        $cab_gereja->nama_gereja = 'GBI Medan Area';
        $cab_gereja->save();
    }
}
