<?php

namespace App\Http\Controllers;

use App\Mail\TanggapanMail;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Mail;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petugas.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporan()
    {
        $datas = Pengaduan::where('status', '!=', 'selesai')->get();
        return view('petugas.laporan', compact('datas'));
    }

    public function laporanAdd()
    {
        return view('petugas.tambah-laporan');
    }

    public function laporanAddPost(Request $request)
    {

        $request->validate([
            'nik' => 'required|string|max:16',
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

        if ($status) {

            return redirect()->route('petugas.laporan')->with('status', 'Laporan berhasil dikirimkan!');
        } else {

            return redirect()->route('petugas.laporan')->with('msg', 'Laporan gagal dikirimkan!');
        }
    }

    public function laporanSelesai()
    {
        $datas = Pengaduan::where('status', '=', 'selesai')->get();
        return view('petugas.laporan-selesai', compact('datas'));
    }

    public function toProses($id, Request $request)
    {
        $status = Pengaduan::where('id', '=', $id)->update(['status' => 'proses']);

        $dataPengaduan = Pengaduan::where('id', '=', $id)->first();
        $dataPelapor = User::where('nik', '=', $dataPengaduan->nik)->first();
        // dd($status);
        $tanggapanStatus = Tanggapan::create([
            'id_pengaduan' => $id,
            'tgl_tanggapan' => $request->tgl_tanggapan,
            'tanggapan' => $request->tanggapan,
            'id_petugas' => Auth::user()->id,
        ]);

        // dd($dataPengaduan);
        $tanggapan = $request->all();
        $pengaduan = $dataPengaduan;

        Mail::to($dataPelapor->email)->send(new TanggapanMail($tanggapan, $pengaduan));

        if ($status) {
            return redirect()->back()->with('status', 'Berhasil update!');
        } else {
            return redirect()->back()->with('msg', 'Gagal update!');
        }
    }

    public function toSelesai($id)
    {
        $status = Pengaduan::where('id', '=', $id)->update(['status' => 'selesai']);

        if ($status) {
            return redirect()->route('petugas.laporan.selesai')->with('status', 'Berhasil update!');
        } else {
            return redirect()->route('petugas.laporan.selesai')->with('msg', 'Gagal update!');
        }
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
