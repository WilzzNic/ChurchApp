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
            $data = RequestAltar::withTrashed()
                    ->where('family_altar_id', auth()->user()->jemaat->ownerFamilyAltar->id)
                    ->whereYear('created_at', $date)
                    ->selectRaw('count(id) as jumlah, MONTH(created_at) as bulan')
                    ->groupBy('bulan')
                    ->get();

            for($i=0; $i<=12; $i++) {
                $temp = $data->where('bulan',$i); 
                if($data->where('bulan',$i)->count() > 0) {
                    $altarRequest[$i] = $temp->first()->jumlah;
                } else {
                    $altarRequest[$i] = 0;
                }
            }

            return view('familyaltar.statistic')->with('data', $altarRequest);
        }
        else if($role ==  User::ROLE_L_BAPTIS) {
            $data = RequestBaptis::withTrashed()
                    ->whereHas('jemaat', function($query) {
                        $query->where('lokasi_ibadah', auth()->user()->jemaat->lokasi_ibadah);
                    })
                    ->whereYear('created_at', $date)
                    ->selectRaw('count(id) as jumlah, MONTH(created_at) as bulan')
                    ->groupBy('bulan')
                    ->get();

            for($i=0; $i<=12; $i++) {
                $temp = $data->where('bulan',$i); 
                if($data->where('bulan',$i)->count() > 0) {
                    $baptisRequest[$i] = $temp->first()->jumlah;
                } else {
                    $baptisRequest[$i] = 0;
                }
            }

            return view('baptis.statistic')->with('data', $baptisRequest);
        }
        else if($role ==  User::ROLE_L_KAJ) {
            $data = RequestKartuAnggota::withTrashed()
                    ->whereHas('jemaat', function($query) {
                        $query->where('lokasi_ibadah', auth()->user()->jemaat->lokasi_ibadah);
                    })
                    ->whereYear('created_at', $date)
                    ->selectRaw('count(id) as jumlah, MONTH(created_at) as bulan')
                    ->groupBy('bulan')
                    ->get();

            for($i=0; $i<=12; $i++) {
                $temp = $data->where('bulan',$i); 
                if($data->where('bulan',$i)->count() > 0) {
                    $kajRequest[$i] = $temp->first()->jumlah;
                } else {
                    $kajRequest[$i] = 0;
                }
            }

            return view('kaj.statistic')->with('data', $kajRequest);
        }
        else {
            $data = RequestKelasOrientasi::withTrashed()
                    ->whereHas('jemaat', function($query) {
                        $query->where('lokasi_ibadah', auth()->user()->jemaat->lokasi_ibadah);
                    })
                    ->whereYear('created_at', $date)
                    ->selectRaw('count(id) as jumlah, MONTH(created_at) as bulan')
                    ->groupBy('bulan')
                    ->get();

            for($i=0; $i<=12; $i++) {
                $temp = $data->where('bulan',$i); 
                if($data->where('bulan',$i)->count() > 0) {
                    $komRequest[$i] = $temp->first()->jumlah;
                } else {
                    $komRequest[$i] = 0;
                }
            }

            return view('kom.statistic')->with('data', $komRequest);
        }
    }

    public function jemaatDt() {
        $role = auth()->user()->role;

        if($role ==  User::ROLE_L_FA) {
            return Laratables::recordsOf(Jemaat::class, function($query) {
                return $query->where('family_altar_id', '=', auth()->user()->jemaat->ownerFamilyAltar->id);
            });
        }
        else {
            return Laratables::recordsOf(Jemaat::class, function($query) {
                return $query->where('lokasi_ibadah', auth()->user()->jemaat->lokasi_ibadah)
                    ->whereHas('user', function($query) {
                        $query->where('role', 'basic_congregation');
                            // ->orWhere('role', 'expert_congregation');
                    });
            });
        }
    }
}
