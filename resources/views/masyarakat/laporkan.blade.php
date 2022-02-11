@extends('layouts.app')
@section('title', 'Home - Masyarakat')
@section('content')

    <div class="card mx-5">
        <div class="card-header">{{ __('Laporkan Masalah') }}</div>

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

            <form action="{{ route('masyarakat.laporkan.post')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="nik" value="{{ Auth::user()->nik }}">

                <div class="row mb-3">
                    <label for="tgl_kejadian" class="col-md-4 col-form-label text-md-start">{{ __('Tanggal Kejadian') }}</label>

                    <div class="col-md-8">
                        <input required max='<?= date('Y-m-d'); ?>' type="date" name="tgl_kejadian" id="tgl_kejadian" rows="4" class="form-control @error('tgl_kejadian') is-invalid @enderror" value="{{ old('tgl_kejadian') }}" autocomplete="tgl_kejadian" autofocus>

                        @error('tgl_kejadian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="isi_laporan" class="col-md-4 col-form-label text-md-start">{{ __('Keterangan Laporan') }}</label>

                    <div class="col-md-8">
                        <textarea name="isi_laporan" id="isi_laporan" rows="4" class="form-control @error('isi_laporan') is-invalid @enderror"  autocomplete="isi_laporan" autofocus>{{ old('isi_laporan') }}</textarea>

                        @error('isi_laporan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-md-4 col-form-label text-md-start">{{ __('Foto Bukti') }} <span class="text-secondary">(opsional)</span></label>

                    <div class="col-md-8">
                        <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value="{{ old('foto') }}"  autocomplete="foto" autofocus>

                        @error('foto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-success" >Kirim</button>
                </div>
            </form>
        </div>
</div>
@endsection
