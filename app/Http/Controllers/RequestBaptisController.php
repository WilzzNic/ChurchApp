<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestBaptisController extends Controller
{
    public function index() {
        return view('baptis.request');
    }
}
