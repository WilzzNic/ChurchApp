<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use App\User;

class ManageAdminController extends Controller
{
    public function index() {
        return view('superadmin.admin.index');
    }

    public function dt() {
        return Laratables::recordsOf(User::class, function($query) {
            return $query->where('role', 'admin');
        });
    }

    public function add() {

    }

    public function delete($id) {
        DB::transaction(function() use ($id) {
            $user = User::find($id);
            $user->jemaat()->delete();
            $user->delete();
        });
        
        return back()->withErrors(['msg' => 'Admin telah dihapus.']);
    }
}
