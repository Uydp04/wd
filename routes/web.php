<?php

use App\Http\Controllers\Admins\AdminSanPhamController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\BuoiHoc4Controller;
use App\Http\Controllers\BuoiHoc5Controller;
use App\Http\Controllers\NhanvienController;
use App\Http\Controllers\Sinh_vienController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// - Routing trong Laravel là chức năng khai báo các đường dẫn
// để đưa người dùng đến các chức năng có trong hệ thống
// - Mỗi một route chỉ sử dụng để trỏ đến 1 chức năng cụ thể

// - Loại 1: Route nạp trực tiếp view
Route::view('/buoi4_1', 'buoi4', [
    'title' => 'Chào mừng quý khách',
    'des' => 'Chúc quý khách vạn sự bình an!'
]);

// - Loại 2: Sử dụng view thông qua controller (Thường dùng)
Route::get('/buoi4_2/{name}/{class}',   [BuoiHoc4Controller::class, 'xinChao']);
Route::get('/buoi5',                    [BuoiHoc5Controller::class, 'buoiHoc5']);


Route::match(['get', 'post'], '/login', [UserController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/register', [UserController::class, 'register'])->name('register');
Route::get('/logout', [UserController::class, 'logout'])->name("logout");


Route::middleware(['auth'])->group(function () {
    Route::resource('sanphams',             AdminSanPhamController::class);
    Route::resource('nhanviens',            NhanvienController::class);
    Route::get('/sinhvien',                 [Sinh_vienController::class, 'index'])->name('sinhvien.index');
    Route::get('/sinhvien/create',          [Sinh_vienController::class, 'create'])->name('sinhvien.create');
    Route::post('/sinhvien',                [Sinh_vienController::class, 'store'])->name('sinhvien.store');
    Route::get('/sinhvien/{sinhvien}',      [Sinh_vienController::class, 'show'])->name('sinhvien.show');
    Route::get('/sinhvien/{sinhvien}/edit', [Sinh_vienController::class, 'edit'])->name('sinhvien.edit');
    Route::put('/sinhvien/{sinhvien}',      [Sinh_vienController::class, 'update'])->name('sinhvien.update');
    Route::delete('/sinhvien/{sinhvien}',   [Sinh_vienController::class, 'destroy'])->name('sinhvien.destroy');
});
// Route::resource('sanphams',             AdminSanPhamController::class);
// Route::get('/sinhvien',                 [Sinh_vienController::class, 'index'])->name('sinhvien.index');
// Route::get('/sinhvien/create',          [Sinh_vienController::class, 'create'])->name('sinhvien.create');
// Route::post('/sinhvien',                [Sinh_vienController::class, 'store'])->name('sinhvien.store');
// Route::get('/sinhvien/{sinhvien}',      [Sinh_vienController::class, 'show'])->name('sinhvien.show');
// Route::get('/sinhvien/{sinhvien}/edit', [Sinh_vienController::class, 'edit'])->name('sinhvien.edit');
// Route::put('/sinhvien/{sinhvien}',      [Sinh_vienController::class, 'update'])->name('sinhvien.update');
// Route::delete('/sinhvien/{sinhvien}',   [Sinh_vienController::class, 'destroy'])->name('sinhvien.destroy');

// //Route::resource('baiviets',             BaiVietController::class);
// route::resource('nhanviens',            NhanvienController::class);


