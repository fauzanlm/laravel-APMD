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
                        <td>{{ $data->tgl_kejadian}}</td>
                        <td>{{ $data->isi_laporan }}</td>
                        <td>
                            @if ($data->foto != NULL)
                                <a href="{{ 'http://localhost:8000/images/'.$data->foto }}" target="_blank">{{ 'http://localhost:8000/images/'.$data->foto }}</a>
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
                                                        <p>Tanggal Tanggapan : {{ $data->tanggapan->tgl_tanggapan }}</p>
                                                        {{ $data->tanggapan->tanggapan }}
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

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- </div> --}}
    </div>
    @endsection
