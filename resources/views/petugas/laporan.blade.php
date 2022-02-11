@extends('layouts.sbadmin')
@section('title', 'Daftar Laporan - Petugas')
@section('content')
{{-- <div class="container"> --}}

    <div class="card mx-2">
        <div class="card-header">
            {{ __('Daftar Laporan') }}
        </div>

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('msg'))
            <div class="alert alert-danger" role="alert">
                {{ session('msg') }}
            </div>
        @endif

        <table class="table mb-3" id="data-laporan" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pelapor</th>
                    <th>Waktu Pengaduan</th>
                    <th>Keluhan</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Tanggapan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($data->user != NULL)
                                {{ $data->user->name }}
                            @else
                                <p class="text-danger">User Belum Terdaftar</p>
                            @endif
                        </td>
                        <td>{{ $data->created_at->diffForHumans() }}</td>
                        <td>{{ $data->isi_laporan }}</td>
                        <td>
                            @if ($data->foto != NULL)
                                <img src="{{ asset('images/'.$data->foto )}}" alt="" width="75px">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                        <td>
                            @if ($data->status == '0')
                                Belum ditanggapi
                            @elseif($data->status == 'proses')
                                Sedang dalam proses
                            @elseif($data->status == 'selesai')
                                Selesai
                            @else
                                Error
                            @endif
                        </td>
                        <td>
                            @if ($data->tanggapan != NULL)
                                <button type="button" class=" btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="{{'#tanggapanModal'.$data->id}}">
                                    Lihat Tanggapan
                                </button>

                                <div class="modal fade" id="{{'tanggapanModal'.$data->id}}" tabindex="-1" role="dialog" aria-labelledby="cekStatusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{'tanggapanModal'.$data->id}}">Catatan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                                <div class="modal-body">
                                                    @if ($data->tanggapan->tanggapan == NULL)
                                                        Tidak ada catatan
                                                    @else
                                                        <p>Tanggal Tanggapan : {{ $data->tanggapan->created_at }}</p>
                                                        <p>Tanggapan : {{ $data->tanggapan->tanggapan }}</p>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                            @else
                                Belum ditanggapi
                            @endif
                        </td>
                        <td>
                            @if ($data->status == '0')

                                <button type="button" class=" btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="{{'#tanggapiModal'.$data->id}}">
                                    Tanggapi
                                </button>

                                <div class="modal fade" id="{{'tanggapiModal'.$data->id}}" tabindex="-1" role="dialog" aria-labelledby="cekStatusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{'tanggapiModal'.$data->id}}">Catatan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="" method="post" action="{{ route('petugas.laporan.toproses', $data->id)}}">
                                                @csrf
                                                @method('patch')

                                                <div class="modal-body">
                                                    <input type="hidden" name="tgl_tanggapan" value="{{ date('d-m-y') }}">
                                                    <textarea name="tanggapan" class="form-control" id="tanggapan" cols="30" rows="4"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Kirim</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($data->status == 'selesai')
                                Selesai
                            @else
                               <a href="{{ route('petugas.laporan.toselesai', $data->id) }}" class="btn btn-success" onclick="return confirm('Selesaikan Laporan?')">Selesai</a>
                            @endif



                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- </div> --}}
    </div>
    @endsection
