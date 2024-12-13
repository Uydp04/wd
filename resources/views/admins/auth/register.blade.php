{{-- Để kế thừa lại master layout ta sử dụng extends --}}
@extends('admins.auth.layouts.master')
{{-- Một file chỉ được kế thừa 1 master layout --}}

@section('title')
    Quản lý sản phẩm
@endsection

@section('CSS')
@endsection

{{-- @section: dùng để chị định phần nội dụng được hiển thị --}}
@section('content')
    <div class="text-center mt-2">
        <h5 class="text-primary">Create New Account</h5>
        <p class="text-muted">Get your free velzon account now</p>
    </div>
    <div class="p-2 mt-4">
        <form class="needs-validation" novalidate action="{{ route('register') }}" method="POST">
            @csrf 

            <div class="mb-3">
                <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="useremail" placeholder="Enter email address" name="email"
                    value="{{ old('email') }}" required> 
                    @error('email')
                        {{ $message }}
                    @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">tên <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="name"
                    value="{{ old('name') }}" required> 
                @error('name')
                    {{ $message }}
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="password-input">mật khẩu</label>
                <div class="position-relative auth-pass-inputgroup">
                    <input type="password" class="form-control pe-5 password-input" onpaste="return false"
                        placeholder="Enter password" id="password-input" name="password"
                        aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                      
                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                        type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                    <div class="invalid-feedback">
                        @error('password')
                                {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            {{-- <div class="mb-4">
                <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the Velzon <a href="#"
                        class="text-primary text-decoration-underline fst-normal fw-medium">Terms of Use</a></p>
            </div> --}}

            {{-- <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                <h5 class="fs-13">Password must contain:</h5>
                <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
            </div> --}}

            <div class="mt-4">
                <button class="btn btn-success w-100" type="submit">đăng kí</button>
            </div>

            <div class="mt-4 text-center">
                <div class="signin-other-title">
                    <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
                </div>

                <div>
                    <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i
                            class="ri-facebook-fill fs-16"></i></button>
                    <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i
                            class="ri-google-fill fs-16"></i></button>
                    <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i
                            class="ri-github-fill fs-16"></i></button>
                    <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i
                            class="ri-twitter-fill fs-16"></i></button>
                </div>
            </div>
        </form>
        <div class="mt-4 text-center">
            <p class="mb-0">Bạn đã có tài khoản rồi <a href="{{ route('login') }}"
                    class="fw-semibold text-primary text-decoration-underline"> Đăng nhập </a> </p>
        </div>
    </div>
@endsection

@section('JS')

@endsection