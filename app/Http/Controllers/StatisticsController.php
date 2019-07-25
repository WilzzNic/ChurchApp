<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\RequestAltar;
use App\RequestBaptis;
use App\RequestKartuAnggota;
use App\RequestKelasOrientasi;
use App\Jemaat;

use Carbon\Carbon;
use Freshbitsweb\Laratables\Laratables;

class StatisticsController extends Controller
{
    public function index() {
        $role = auth()->user()->role;

        $date = Carbon::now();

        if($role ==  User::ROLE_L_FA){
            $data = RequestAltar::whereYear('created_at', $date)
                ->selectRaw('COUNT(*) as count, YEAR(created_at) year, MONTH(created_at) month')
                ->groupBy('year','month')
                ->get();

            $data = array_column($data->toArray(), 'count');

            return view('familyaltar.statistic', compact('data'));
        }
        else if($role ==  User::ROLE_L_BAPTIS) {
            $data = RequestBaptis::whereYear('created_at', $date)
                ->selectRaw('COUNT(*) as count, YEAR(created_at) year, MONTH(created_at) month')
                ->groupBy('year','month')
                ->get();

            $data = array_column($data->toArray(), 'count');
            return view('baptis.statistic', compact('data'));
        }
        else if($role ==  User::ROLE_L_KAJ) {
            $data = RequestKartuAnggota::whereYear('created_at', $date)
                ->selectRaw('COUNT(*) as count, YEAR(created_at) year, MONTH(created_at) month')
                ->groupBy('year','month')
                ->get();

            $data = array_column($data->toArray(), 'count');

            return view('kaj.statistic', compact('data'));
        }
        else {
            $data = RequestKelasOrientasi::whereYear('created_at', $date)
                ->selectRaw('COUNT(*) as count, YEAR(created_at) year, MONTH(created_at) month')
                ->groupBy('year','month')
                ->get();

            $data = array_column($data->toArray(), 'count');
            return view('kom.statistic', compact('data'));
        }
    }

    public function jemaatDt() {
        return Laratables::recordsOf(Jemaat::class);
    }
}
