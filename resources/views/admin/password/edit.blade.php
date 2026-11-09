@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin-theme.css') }}">
@stop

@section('title', 'Ubah Kata Sandi')

@section('content_header')
    <h1>Ubah Kata Sandi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Perbarui password akun</h3></div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password saat ini</label>
                            <input id="current_password" name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" required autocomplete="current-password">
                            @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password baru</label>
                            <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="form-text">Gunakan minimal 8 karakter.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi password baru</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-dark">Simpan Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
