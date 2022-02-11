<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register APMD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .gradient {
            background: linear-gradient(90deg, #011af7 30%, #f5862c 100%);
        }
    </style>
</head>
<body>
<div class="mx-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-header gradient text-white">
                    <div class="form-row">
                        {{-- <div class="form-group col-lg-4 mt-4 ml-3">
                            <img src="http://localhost:8000/logo/logo_wk.png" width="120" height="120" class="text-center ml-2">
                        </div> --}}
                        <div class="mx-3">

                            <div class="form-group col-lg-10 mt-4">
                                <strong>
                                    <h1 class="font">Form Pendaftaran
                                        <br>
                                        Aplikasi Pengaduan Masyarakat Digital
                                    </h1>
                                </strong>
                                <p class="font">Silahkan Isi data diri anda pada form berikut ini !</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-3">

                    <div class="card-body mt-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <input type="hidden" value="12345678" name="password">
                                <div class="form-group mb-3">
                                    <label for="name">{{ __('Nama') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nik">{{ __('NIK') }}</label>
                                    <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus>

                                    @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>


                            <div class="form-group mb-3">
                                <label for="email">{{ __('Alamat E-Mail') }}</label>


                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group mb-3">
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
                                <div class="">

                                    <button type="submit" onclick="return confirm('Apakah Data Sudah benar?')" class="btn btn-primary">
                                        Daftar
                                    </button>
                                    <p class="mt-2">Sudah terdaftar? <a href="/login">login disini</a></p>
                                </div>
                            </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
