<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Đăng nhập
    public function login(UserRequest $request) {
        if ($request->isMethod('POST')) {
            if (Auth::attempt(['email'=>$request->email, 'password'=> $request->password])) {
                return redirect()->route('sinhvien.index');
            } else {
                session()->flash('error', 'Sai thông tin đăng nhập');
                return redirect()->route('login');
            }
        }
        return view('admins.auth.login');
    }

    // Đăng ký
    public function register(UserRequest $request) {
        if ($request->isMethod('POST')) {
            // Lấy toàn bộ dữ liệu trong form đăng ký mà chúng ta gửi lên
            $params = $request->except("_token");
            // Mã hóa mật khẩu người dùng cung cấp
            $params["password"] = Hash::make($request->password);
            // Đặt giá trị email_verified_at là thời gian hiện tại
            $params["email_verified_at"] = Carbon::now('Asia/Ho_Chi_Minh');
            $user = User::create($params);

            if ($user->id) {
                session()->flash('error', 'Sai thông tin đăng nhập');
                return redirect()->route('login');
            }
        }
        return view('admins.auth.register');
    }

    // Đăng xuất
    public function logout () {
        Auth::logout();
        return redirect()->route('login');
    }
}
