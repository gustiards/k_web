<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DmoController extends Controller
{
    /**
     * Tampilkan halaman berita acara
     */
    public function index()
    {
        // Default heading (acuan tetap ada)
        $heading = "MR D.I.Y A YANI PLAJU TANGGA TAKAT";
        $subheading = "JL A YANI TANGGA TAKAT SEBERANG ULU II Palembang.";

        return view('damage.dmo', compact('heading', 'subheading'));
    }

    /**
     * Upload dokumentasi (optional jika mau disimpan ke server)
     */
    public function upload(Request $request)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $paths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $paths[] = $image->store('damage-documentation', 'public');
            }
        }

        return response()->json([
            'success' => true,
            'paths' => $paths
        ]);
    }
}