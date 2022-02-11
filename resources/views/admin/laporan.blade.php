@extends('layouts.sbadmin')
@section('title', 'Laporan - Admin')
@section('content')

    <div class="card mx-2">
        <div class="card-header">{{ __('Daftar Pengaduan') }}</div>

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

        <table class="table mb-3" id="data-laporan-admin" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pelapor</th>
                    <th>Waktu Pengaduan</th>
                    <th>Tanggal Kejadian</th>
                    <th>Keluhan</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Tanggapan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->tgl_kejadian}}</td>
                        <td>{{ $data->isi_laporan }}</td>
                        <td>
                            @if ($data->foto != NULL)
                                <a href="{{ 'http://localhost:8000/images/'.$data->foto }}" target="_blank">{{ 'http://localhost:8000/images/'.$data->foto }}</a>
                            @else
                                Tidak ada foto
                            @endif
                            {{-- <img src="{{ asset('images/'.$data->foto )}}" alt="" width="75px"> --}}
                        </td>
                        <td>
                            @if ($data->status == '0')
                                Belum ditanggapi
                            @elseif ($data->status == 'proses')

                                Sedang dalam proses
                            @elseif ($data->status == 'selesai')
                                Selesai
                            @else
                                Error
                            @endif
                        </td>
                        <td>
                        @if ($data->tanggapan != NULL)
                            @if ($data->tanggapan->tanggapan == NULL)
                                Tidak ada catatan
                            @else
                                {{ $data->tanggapan->tanggapan }}
                            @endif
                        @else
                            Belum ditanggapi
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
</div>
@endsection
