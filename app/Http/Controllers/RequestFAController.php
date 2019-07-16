<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestFAController extends Controller
{
    public function index() {
        return view('familyaltar.request');
    }
}
