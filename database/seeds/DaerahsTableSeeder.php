<?php

use Illuminate\Database\Seeder;
use App\Daerah;

class DaerahsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daerah = new Daerah();
        $daerah->nama_daerah = 'Medan Johor';
        $daerah->save();

        $daerah = new Daerah();
        $daerah->nama_daerah = 'Medan Area';
        $daerah->save();

        $daerah = new Daerah();
        $daerah->nama_daerah = 'Medan Barat';
        $daerah->save();
    }
}
