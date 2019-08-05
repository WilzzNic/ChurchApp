<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\RequestKelasOrientasi;

class RequestKelasOrientasisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $request = new RequestKelasOrientasi();
        $request->jemaat_id = 11;
        $request->jadwal_kom_id = 2;
        $request->asal_gereja = 'HKBP Medan Raya';
        $request->tanggal = Carbon::now()->subMonths(1)->addDays(6);
        $request->status = RequestKelasOrientasi::STATUS_REJECTED;
        $request->created_at = Carbon::now()->subMonths(1);
        $request->updated_at = Carbon::now()->subMonths(1);
        $request->deleted_at = Carbon::now()->subMonths(1);
        $request->save();

        $request = new RequestKelasOrientasi();
        $request->jemaat_id = 11;
        $request->jadwal_kom_id = 2;
        $request->asal_gereja = 'HKBP Medan Raya';
        $request->tanggal = Carbon::now()->subMonths(2)->addDays(10);
        $request->status = RequestKelasOrientasi::STATUS_REJECTED;
        $request->created_at = Carbon::now()->subMonths(2);
        $request->updated_at = Carbon::now()->subMonths(2);
        $request->deleted_at = Carbon::now()->subMonths(2);
        $request->save();

        $request = new RequestKelasOrientasi();
        $request->jemaat_id = 11;
        $request->jadwal_kom_id = 2;
        $request->asal_gereja = 'HKBP Medan Raya';
        $request->tanggal = Carbon::now()->subMonths(1)->addDays(11);
        $request->status = RequestKelasOrientasi::STATUS_REJECTED;
        $request->created_at = Carbon::now()->subMonths(3);
        $request->updated_at = Carbon::now()->subMonths(3);
        $request->deleted_at = Carbon::now()->subMonths(3);
        $request->save();

        $request = new RequestKelasOrientasi();
        $request->jemaat_id = 13;
        $request->jadwal_kom_id = 2;
        $request->asal_gereja = 'HKBP Medan Raya';
        $request->tanggal = Carbon::now()->subMonths(1)->addDays(11);
        $request->status = RequestKelasOrientasi::STATUS_ENROLLING;
        $request->created_at = Carbon::now()->subMonths(1);
        $request->updated_at = Carbon::now()->subMonths(1);
        $request->save();
    }
}
