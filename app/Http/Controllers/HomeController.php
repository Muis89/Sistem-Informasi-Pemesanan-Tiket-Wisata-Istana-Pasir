<?php

namespace App\Http\Controllers;

use App\Models\Tiket;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome', ['tikets' => Tiket::latest()->get()]);
    }
}
