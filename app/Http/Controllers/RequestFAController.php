<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\FamilyAltar;

class RequestFAController extends Controller
{
    public function index() {
        return view('familyaltar.request');
    }

    public function populateFA() {
        return Laratables::recordsOf(FamilyAltar::class);
    }
}
