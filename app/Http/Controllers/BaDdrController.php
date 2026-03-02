<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaDdrController extends Controller
{
    /**
     * Tampilkan halaman Berita Acara DDR
     */
    public function index()
    {
        // Menampilkan Blade view ba_ddr.blade.php
        return view('ba_ddr');
    }
}