<?php

namespace App\Http\Controllers;

use App\Mail\PengaduanMail;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Auth;
use Mail;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Pengaduan::where('nik', '=', Auth::user()->nik)->get();
        return view('masyarakat.home', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masyarakat.laporkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi_laporan' => 'required|string',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->foto != NULL) {
            $imgName = time().'.'.$request->file('foto')->getClientOriginalName();
            $request->foto->move(public_path('images'), $imgName);
        }else{
            $imgName = NULL;
        }



        $status = Pengaduan::create([
            'tgl_kejadian' => $request->tgl_kejadian,
            'nik' => $request->nik,
            'isi_laporan' => $request->isi_laporan,
            'foto' => $imgName,
        ]);

        $request['id'] = time() . '-'. $status->id;
        dd($request['id']);
        $pengaduan = $request->all();
        Mail::to(Auth::user()->email)->send(new PengaduanMail($pengaduan));

        if ($status) {

            return redirect()->route('masyarakat.home')->with('status', 'Laporan berhasil dikirimkan!');
        } else {

            return redirect()->route('masyarakat.home')->with('msg', 'Laporan gagal dikirimkan!');
        }

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
