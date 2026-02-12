<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoverStController extends Controller
{
    /**
     * Menampilkan halaman upload & print rack
     */
    public function index()
    {
        return view('coverst.index');
    }
}
