@extends('layouts.sbadmin')
@section('title', 'Daftar Petugas - Admin')
@section('content')

    <div class="card mx-2">
        <div class="card-header">{{ __('Daftar Petugas') }}
            <a href="{{ route('admin.petugas.add')}}" class="btn btn-primary btn-sm float-right">Tambah Petugas</a>
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

        <table class="table" id="data-laporan" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Petugas</th>
                    <th>Nomor Telepon</th>
                    <th>Email</th>
                    <th>Waktu Pembuatan User</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
@endsection
