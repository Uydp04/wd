{{-- Để kế thừa lại master layout ta sử dụng extends --}}
@extends('admins.auth.layouts.master')
{{-- Một file chỉ được kế thừa 1 master layout --}}

@section('title')
    Quản lý sản phẩm
@endsection

@section('CSS')
@endsection


@section('content')
<div class="text-center mt-2">
    <h5 class="text-primary">Welcome Back !</h5>
    <p class="text-muted">Sign in to continue to Velzon.</p>
</div>
<div class="p-2 mt-4">
    <form action="{{ route('login') }}"method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="username" placeholder="email">
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            {{-- <div class="float-end">
                <a href="auth-pass-reset-basic.html" class="text-muted">Quên mật khẩu</a>
            </div> --}}
            <label class="form-label" for="password-input">Mật khẩu</label>
            <div class="position-relative auth-pass-inputgroup mb-3">
                <input type="password" name="password" class="form-control pe-5 password-input" placeholder="Mật khẩu" id="password-input">
                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
            </div>
            @error('password')
                    <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
            <label class="form-check-label" for="auth-remember-check">nhớ mật khẩu</label>
        </div>

        <div class="mt-4">
            <button class="btn btn-success w-100" type="submit">Đăng nhập</button>
        </div>

        <div class="mt-4 text-center">
            <div class="signin-other-title">
                <h5 class="fs-13 mb-4 title">Sign In with</h5>
            </div>
            <div>
                <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>
                <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></button>
                <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></button>
            </div>
        </div>

    </form>
    <div class="mt-4 text-center">
        <p class="mb-0">Bạn chưa có tài khoản ? <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-underline"> Đăng kí </a> </p>
    </div>
</div>
@endsection

@section('JS')

@endsection