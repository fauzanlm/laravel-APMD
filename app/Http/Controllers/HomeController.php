<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->level == 'masyarakat') {
            return redirect()->route('masyarakat.home');
        }
        else if (Auth::user()->level == 'petugas') {
            return redirect()->route('petugas.home');
        }
        else if (Auth::user()->level == 'admin') {
            return redirect()->route('admin.home');
        }
    }
}
