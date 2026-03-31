@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">

    <div class="card p-4 shadow" style="width: 400px;">

        <h4 class="text-center mb-3">Register</h4>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                Terjadi kesalahan, cek input kamu!
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- NAMA --}}
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name"
                       class="form-control"
                       required>
            </div>

            {{-- EMAIL --}}
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email"
                       class="form-control"
                       required>
            </div>

            {{-- PASSWORD --}}
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password"
                       class="form-control"
                       required>
            </div>

            {{-- KONFIRMASI PASSWORD --}}
            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="form-control"
                       required>
            </div>

            <button class="btn btn-merah w-100">
                Daftar
            </button>

        </form>

        {{-- LINK KE LOGIN --}}
        <div class="text-center mt-3">
            <small>
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-decoration-none fw-bold">
                    Login disini
                </a>
            </small>
        </div>

    </div>

</div>

@endsection