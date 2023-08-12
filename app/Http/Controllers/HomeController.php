<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('beranda.admin');
        } elseif (Auth::user()->hasRole('kepsek')) {
            return redirect()->route('beranda.kepsek');
        }
        return redirect()->route('beranda.siswa');
    }
}
