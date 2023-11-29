<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    public function Beranda()
    {
        return view('page.pengunjung.beranda');
    }


}
