<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([JemaatTableSeeder::class]);
        $this->call([DaerahsTableSeeder::class]);
        $this->call([FamilyAltarsTableSeeder::class]);
        $this->call([CabangGerejasTableSeeder::class]);
        $this->call([JadwalKOMsTableSeeder::class]);
        $this->call([RequestAltarsTableSeeder::class]);
        $this->call([RequestBaptisTableSeeder::class]);
        $this->call([RequestKelasOrientasisTableSeeder::class]);
        $this->call([RequestKartuAnggotasTableSeeder::class]);
        
    }
}
