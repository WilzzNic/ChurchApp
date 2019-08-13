<?php

namespace App\Http\Controllers\LeaderKOM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\Mail;

use App\GuestRequestKOM;
use App\Mail\KOMStatusMail;
use App\Mail\KOMRejectMail;
use App\Mail\KOMCompletedMail;

class ManageRequestController extends Controller
{
    public function indexPending() {
        return view('guest.pending');
    }

    public function pendingDt() {
        return Laratables::recordsOf(GuestRequestKOM::class, function($query) {
            return $query->where('status', GuestRequestKOM::STATUS_PENDING)
            ->whereHas('jadwal', function($q) {
                $q->where('cabang_gereja_id', '=', auth()->user()->jemaat->lokasi_ibadah);
            });
        });
    }

    public function approvePending($id) {
        $request = GuestRequestKOM::find($id);
        $request->status = GuestRequestKOM::STATUS_ENROLLING;
        $request->save();

        Mail::to($request->guest->email)->send(new KOMStatusMail($request));

        return back()->withStatus(__('Permohonan telah diterima.'));
    }

    public function rejectPending($id) {
        $request = GuestRequestKOM::find($id);
        $request->status = GuestRequestKOM::STATUS_REJECTED;

        Mail::to($request->guest->email)->send(new KOMRejectMail($request));

        $request->save();
        $request->delete();

        return back()->withStatus(__('Permohonan telah ditolak.'));
    }

    public function indexEnrolling() {
        return view('guest.enrolling');
    }

    public function enrollingDt() {
        return Laratables::recordsOf(GuestRequestKOM::class, function($query) {
            return $query->where('status', GuestRequestKOM::STATUS_ENROLLING)
            ->whereHas('jadwal', function($q) {
                $q->where('cabang_gereja_id', '=', auth()->user()->jemaat->lokasi_ibadah);
            });
        });
    }

    public function complete($id) {
        $request = GuestRequestKOM::find($id);
        $request->status = GuestRequestKOM::STATUS_COMPLETED;
        $request->save();

        Mail::to($request->guest->email)->send(new KOMCompletedMail($request));

        return back()->withStatus(__('Simpatisan telah dinyatakan selesai dalam menjalani modul.'));
    }

    public function indexCompleted() {
        return view('guest.completed');
    }

    public function completedDt() {
        return Laratables::recordsOf(GuestRequestKOM::class, function($query) {
            return $query->where('status', GuestRequestKOM::STATUS_COMPLETED)
            ->whereHas('jadwal', function($q) {
                $q->where('cabang_gereja_id', '=', auth()->user()->jemaat->lokasi_ibadah);
            });
        });
    }
}
