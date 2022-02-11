<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    public function petugas()
    {
        $datas = User::where('level', '=', 'petugas')->get();
        return view('admin.petugas', compact('datas'));
    }

    public function petugasAdd()
    {
        return view('admin.tambah-petugas');
    }

    public function petugasAddPost(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16'],
            'phone' => ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // $password_random = Str::random(8);
        $status = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'petugas',
            'email_verified_at' => now()
        ]);

        if ($status) {
            return redirect()->route('admin.petugas')->with('status', 'Petugas berhasil ditambahkan!');
        } else {
            return redirect()->route('admin.petugas')->with('msg', 'Petugas gagal ditambahkan!');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporan()
    {
        $datas = Pengaduan::all();
        return view('admin.laporan', compact('datas'));
    }

    public function laporanBelumDitanggapi()
    {
        $datas = Pengaduan::where('status', '=', '0')->get();
        return view('admin.laporan', compact('datas'));
    }

    public function laporanDalamProses()
    {
        $datas = Pengaduan::where('status', '=', 'proses')->get();
        return view('admin.laporan', compact('datas'));
    }

    public function laporanSudahSelesai()
    {
        $datas = Pengaduan::where('status', '=', 'selesai')->get();
        return view('admin.laporan', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
