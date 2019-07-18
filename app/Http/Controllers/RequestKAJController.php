<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestKAJController extends Controller
{
    public function index() {
        return view('kaj.request');
    }
}
