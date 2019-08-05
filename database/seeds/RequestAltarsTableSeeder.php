<?php

use Illuminate\Database\Seeder;

use App\RequestAltar;
use Carbon\Carbon;

class RequestAltarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $now = Carbon::now();
        $request = new RequestAltar();
        $request->jemaat_id = 10;
        $request->family_altar_id = 1;
        $request->status = RequestAltar::STATUS_PENDING;
        $request->created_at = $now->subMonths(1);
        $request->updated_at = $now->subMonths(1);
        $request->save();

        $now = Carbon::now();
        $request = new RequestAltar();
        $request->jemaat_id = 11;
        $request->family_altar_id = 1;
        $request->status = RequestAltar::STATUS_ACCEPTED;
        $request->created_at = $now->subMonths(1);
        $request->updated_at = $now->subMonths(1);
        $request->save();

        $now = Carbon::now();
        $request = new RequestAltar();
        $request->jemaat_id = 12;
        $request->family_altar_id = 1;
        $request->status = RequestAltar::STATUS_ACCEPTED;
        $request->created_at = $now->subMonths(1);
        $request->updated_at = $now->subMonths(1);
        $request->save();

        $now = Carbon::now();
        $request = new RequestAltar();
        $request->jemaat_id = 13;
        $request->family_altar_id = 1;
        $request->status = RequestAltar::STATUS_ACCEPTED;
        $request->created_at = $now;
        $request->updated_at = $now;
        $request->save();
    }
}
