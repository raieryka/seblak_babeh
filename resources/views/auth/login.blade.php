@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">

    <div class="card p-4 shadow" style="width: 400px;">

        <h4 class="text-center mb-3">Login</h4>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                Email atau password salah!
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- 🔥 ROLE (PINDAH KE DALAM FORM) --}}
            <div class="mb-3">
                <label>Login sebagai</label>
                <select name="role" class="form-control">
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>
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

            <button class="btn btn-merah w-100">
                Login
            </button>

        </form>

        {{-- DAFTAR --}}
        <p class="text-center mt-3 mb-0">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-danger fw-bold">
                Daftar
            </a>
        </p>

    </div>

</div>

@endsection