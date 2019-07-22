<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // 'name' => 'Admin Admin',
            'email' => 'admin@argon.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            // 'name' => 'Admin Admin',
            'email' => 'wilson.nicholas56@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'role' => 'basic_congregation',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            // 'name' => 'Admin Admin',
            'email' => 'okkybarus@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'role' => 'basic_congregation',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'email' => 'andi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'role' => 'FA_leader',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'email' => 'budi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'role' => 'KAJ_leader',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'email' => 'emily@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'role' => 'baptis_leader',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
