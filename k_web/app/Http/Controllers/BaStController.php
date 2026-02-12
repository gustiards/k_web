<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaStController extends Controller
{
    /**
     * Tampilkan halaman BA Stock Take
     */
    public function index()
    {
        return view('ba_st');
    }
}
