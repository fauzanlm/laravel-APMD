@extends('layouts.app')

@section('content')
<div class="mx-5">
<div class="mx-5">
<div class="mx-5">

    <div class="row justify-content-center">
        <div class="">
            <div class="card mt-4">
                <div class="card-header gradient text-white" id="gradient2">
                    <div class="form-row">

                        <div class="form-group  mt-4">
                            <strong>
                                <h1 class="font">Form Login
                                    <br>
                                    Aplikasi Pengaduan Masyarakat Digital
                                </h1>
                            </strong>
                            <p class="font">Silahkan Isi form berikut ini !</p>
                        </div>
                    </div>
                </div>
                <div class="mx-5">

                    <div class="card-body mt-2 mb-2">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class=" col-form-label ">{{ __('Alamat E-Mail') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class=" col-form-label ">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Masuk') }}
                                </button>
                                Belum punya akun? registrasi <a href="{{ route('register') }}">disini</a>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    </div>
                </div>

            </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
