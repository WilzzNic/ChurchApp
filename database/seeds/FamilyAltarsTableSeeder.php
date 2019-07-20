<?php

use Illuminate\Database\Seeder;
use App\FamilyAltar;
use App\Jemaat;

class FamilyAltarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $familyAltar = new FamilyAltar();
        $familyAltar->owner_id = 1;
        $familyAltar->daerah_id = 1;
        $familyAltar->FA_number = 20134;
        $familyAltar->alamat = 'Jl. Adam Malik No.2A';
        $familyAltar->hari = 'Sabtu';
        $familyAltar->waktu = '08:00:00';
        $familyAltar->save();
    }
}
