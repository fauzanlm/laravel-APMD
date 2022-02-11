@extends('layouts.sbadmin')
@section('title', 'Tambah Petugas - Admin')
@section('content')

            <div class="card">
                <div class="card-header">{{ __('Tambah Petugas') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.petugas.add.post') }}">
                        @csrf
                        <input type="hidden" name="password" value="12345678">
                            <div class=" mb-3">
                                <label for="name">{{ __('Nama') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class=" mb-3">
                                <label for="nik">{{ __('NIK') }}</label>
                                <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus>

                                @error('nik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>


                        <div class=" mb-3">
                            <label for="email">{{ __('Alamat E-Mail') }}</label>


                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class=" mb-3">
                            <label for="phone">{{ __('Nomor Telepon') }}</label>


                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group mb-3">
                            <label for="password">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group mb-3">
                            <label for="password-confirm">{{ __('Konfirmasi Password') }}</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                        </div>

                        <div class="row">
                            <div class="col-lg-1">

                                <button type="submit" class="btn btn-primary">
                                    Tambahkan
                                </button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>

@endsection
