<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\RequestBaptis;

class RequestBaptisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $request = new RequestBaptis();
        $request->jemaat_id = 10;
        $request->cabang_gereja_id = 1;
        $request->waktu = Carbon::now();
        $request->tanggal = Carbon::now();
        $request->status = RequestBaptis::STATUS_REJECTED;
        $request->created_at = Carbon::now()->subMonths(7);
        $request->updated_at = Carbon::now()->subMonths(7);
        $request->deleted_at = Carbon::now()->subMonths(7);
        $request->save();

        $request = new RequestBaptis();
        $request->jemaat_id = 10;
        $request->cabang_gereja_id = 1;
        $request->waktu = Carbon::now();
        $request->tanggal = Carbon::now();
        $request->status = RequestBaptis::STATUS_REJECTED;
        $request->created_at = Carbon::now()->subMonths(7);
        $request->updated_at = Carbon::now()->subMonths(7);
        $request->deleted_at = Carbon::now()->subMonths(7);
        $request->save();

        $now = Carbon::now();
        $request = new RequestBaptis();
        $request->jemaat_id = 10;
        $request->cabang_gereja_id = 2;
        $request->waktu = Carbon::now();
        $request->tanggal = Carbon::now();
        $request->status = RequestBaptis::STATUS_REJECTED;
        $request->created_at = Carbon::now()->subMonths(7);
        $request->updated_at = Carbon::now()->subMonths(7);
        $request->deleted_at = Carbon::now()->subMonths(7);
        $request->save();

        $now = Carbon::now();
        $request = new RequestBaptis();
        $request->jemaat_id = 10;
        $request->cabang_gereja_id = 2;
        $request->waktu = Carbon::now();
        $request->tanggal = Carbon::now();
        $request->status = RequestBaptis::STATUS_ACCEPTED;
        $request->created_at = Carbon::now()->subMonths(7);
        $request->updated_at = Carbon::now()->subMonths(7);
        $request->save();

        $now = Carbon::now();
        $request = new RequestBaptis();
        $request->jemaat_id = 11;
        $request->cabang_gereja_id = 1;
        $request->waktu = Carbon::now();
        $request->tanggal = Carbon::now()->addMonths(2);
        $request->status = RequestBaptis::STATUS_ACCEPTED;
        $request->created_at = Carbon::now()->subMonths(7);
        $request->updated_at = Carbon::now()->subMonths(7);
        $request->save();

        $now = Carbon::now();
        $request = new RequestBaptis();
        $request->jemaat_id = 12;
        $request->cabang_gereja_id = 1;
        $request->waktu = Carbon::now();
        $request->tanggal = Carbon::now()->addMonths(3);
        $request->status = RequestBaptis::STATUS_ACCEPTED;
        $request->created_at = Carbon::now()->subMonths(5);
        $request->updated_at = Carbon::now()->subMonths(5);
        $request->save();

        $now = Carbon::now();
        $request = new RequestBaptis();
        $request->cabang_gereja_id = 2;
        $request->jemaat_id = 13;
        $request->waktu = Carbon::now();
        $request->tanggal = Carbon::now()->addMonths(2);
        $request->status = RequestBaptis::STATUS_ACCEPTED;
        $request->created_at = Carbon::now()->subMonths(2);
        $request->updated_at = Carbon::now()->subMonths(2);
        $request->save();
    }
}
