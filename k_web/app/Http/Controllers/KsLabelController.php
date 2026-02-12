<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KsLabelController extends Controller
{
    public function index()
    {
        return view('kslabel.index');
    }
}
