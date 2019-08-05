<?php

use Illuminate\Database\Seeder;

use App\RequestKartuAnggota;
use Carbon\Carbon;

class RequestKartuAnggotasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $request = new RequestKartuAnggota();
        $request->jemaat_id = 10;
        $request->status = RequestKartuAnggota::STATUS_ACCEPTED;
        $request->created_at = Carbon::now()->subMonths(6);
        $request->updated_at = Carbon::now()->subMonths(5);
        $request->save();

        $request = new RequestKartuAnggota();
        $request->jemaat_id = 11;
        $request->status = RequestKartuAnggota::STATUS_ACCEPTED;
        $request->created_at = Carbon::now()->subMonths(7);
        $request->updated_at = Carbon::now()->subMonths(6);
        $request->save();

        $request = new RequestKartuAnggota();
        $request->jemaat_id = 12;
        $request->status = RequestKartuAnggota::STATUS_ACCEPTED;
        $request->created_at = Carbon::now()->subMonths(7);
        $request->updated_at = Carbon::now()->subMonths(6);
        $request->save();

        $request = new RequestKartuAnggota();
        $request->jemaat_id = 13;
        $request->status = RequestKartuAnggota::STATUS_ACCEPTED;
        $request->created_at = Carbon::now()->subMonths(7);
        $request->updated_at = Carbon::now()->subMonths(6);
        $request->save();

    }
}
