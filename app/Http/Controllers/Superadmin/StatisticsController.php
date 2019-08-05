<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Carbon\Carbon;

use App\Jemaat;
use App\RequestBaptis;
use App\RequestAltar;
use App\RequestKartuAnggota;
use App\RequestKelasOrientasi;
use App\User;

class StatisticsController extends Controller
{
    public function index() {
        $date = Carbon::now();

        $altar_requests = RequestAltar::withTrashed()
                ->whereYear('created_at', $date)
                ->selectRaw('count(id) as jumlah, MONTH(created_at) as bulan')
                ->groupBy('bulan')
                ->get();

        for($i=0; $i<12; $i++) {
            $temp = $altar_requests->where('bulan', $i+1); 
            if($temp->count() > 0) {
                $altarRequest[$i] = $temp->first()->jumlah;
            } else {
                $altarRequest[$i] = 0;
            }
        }

        $baptis_requests = RequestBaptis::withTrashed()
                ->whereYear('created_at', $date)
                ->selectRaw('count(id) as jumlah, MONTH(created_at) as bulan')
                ->groupBy('bulan')
                ->get();
        

        for($i=0; $i<12; $i++) {
            $temp = $baptis_requests->where('bulan', $i+1); 
            if($temp->count() > 0) {
                $baptisRequest[$i] = $temp->first()->jumlah;
            } else {
                $baptisRequest[$i] = 0;
            }
        }

        $kaj_requests = RequestKartuAnggota::withTrashed()
                ->whereYear('created_at', $date)
                ->selectRaw('count(id) as jumlah, MONTH(created_at) as bulan')
                ->groupBy('bulan')
                ->get();
        
        for($i=0; $i<12; $i++) {
            $temp = $kaj_requests->where('bulan', $i+1); 
            if($temp->count() > 0) {
                $kajRequest[$i] = $temp->first()->jumlah;
            } else {
                $kajRequest[$i] = 0;
            }
        }

        $kom_requests = RequestKelasOrientasi::withTrashed()
                ->whereYear('created_at', $date)
                ->selectRaw('count(id) as jumlah, MONTH(created_at) as bulan')
                ->groupBy('bulan')
                ->get();

        for($i=0; $i<12; $i++) {
            $temp = $kom_requests->where('bulan', $i+1); 
            if($temp->count() > 0) {
                $komRequest[$i] = $temp->first()->jumlah;
            } else {
                $komRequest[$i] = 0;
            }
        }

        return view('superadmin.statistic.index')->with('altar_requests', $altarRequest)
                        ->with('baptis_requests', $baptisRequest)
                        ->with('kaj_requests', $kajRequest)
                        ->with('kom_requests', $komRequest);
    }

    public function dtJemaat() {
        return Laratables::recordsOf(Jemaat::class, function($query) {
            return $query->whereHas('user', function($query) {
                $query->whereIn('role', [User::ROLE_B_CON, User::ROLE_L_FA]);
            });
        });
    }
}
