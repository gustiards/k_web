<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListDamageController extends Controller
{
    public function index()
    {
        return view('list_damage');
    }
}
