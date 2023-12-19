<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use app\Http\Controllers\ChuDeController;
use app\Http\Controllers\BaiVietController;
use app\Http\Controllers\BinhLuanBaiVietController;
// đnagư ký, đăng nhập, quên mật khẩu
Auth::routes();

// trang chủ
Route::get('/', [HomeController::class, 'getHome'])->name('home');
Route::get('/home', [HomeController::class, 'getHome'])->name('home');

// Tin tức
//Route::get('/bai-viet', [HomeController::class, 'getBaiViet'])->name('baiviet');
//Route::get('/bai-viet/{tenchude_slug}', [HomeController::class, 'getBaiViet'])->name('baiviet.chude');
//Route::get('/bai-viet/{tenchude_slug}/{tieude_slug}', [HomeController::class, 'getBaiViet_ChiTiet'])->name('baiviet.chitiet');


// Quản lý Tài khoản người dùng
Route::get('/user', [UserController::class, 'getDanhSach'])->name('user');
Route::get('/user/them', [UserController::class, 'getThem'])->name('user.them');
Route::post('/user/them', [UserController::class, 'postThem'])->name('user.them');
Route::get('/user/sua/{id}', [UserController::class, 'getSua'])->name('user.sua');
Route::post('/user/sua/{id}', [UserController::class, 'postSua'])->name('user.sua');
Route::get('/user/xoa/{id}', [UserController::class, 'getXoa'])->name('user.xoa');

// Quản lý Chủ đề
Route::get('/chude', [ChuDeController::class, 'getDanhSach'])->name('chude');
Route::get('/chude/them', [ChuDeController::class, 'getThem'])->name('chude.them');
Route::post('/chude/them', [ChuDeController::class, 'postThem'])->name('chude.them');
Route::get('/chude/sua/{id}', [ChuDeController::class, 'getSua'])->name('chude.sua');
Route::post('/chude/sua/{id}', [ChuDeController::class, 'postSua'])->name('chude.sua');
Route::get('/chude/xoa/{id}', [ChuDeController::class, 'getXoa'])->name('chude.xoa');

// Quản lý Bài viết
Route::get('/baiviet', [BaiVietController::class, 'getDanhSach'])->name('baiviet');
Route::get('/baiviet/them', [BaiVietController::class, 'getThem'])->name('baiviet.them');
Route::post('/baiviet/them', [BaiVietController::class, 'postThem'])->name('baiviet.them');
Route::get('/baiviet/sua/{id}', [BaiVietController::class, 'getSua'])->name('baiviet.sua');
Route::post('/baiviet/sua/{id}', [BaiVietController::class, 'postSua'])->name('baiviet.sua');
Route::get('/baiviet/xoa/{id}', [BaiVietController::class, 'getXoa'])->name('baiviet.xoa');
Route::get('/baiviet/kiemduyet/{id}', [BaiVietController::class, 'getKiemDuyet'])->name('baiviet.kiemduyet');
Route::get('/baiviet/kichhoat/{id}', [BaiVietController::class, 'getKichHoat'])->name('baiviet.kichhoat');

// Quản lý Bình luận bài viết
Route::get('/binhluanbaiviet', [BinhLuanBaiVietController::class, 'getDanhSach'])->name('binhluanbaiviet');
Route::get('/binhluanbaiviet/them', [BinhLuanBaiVietController::class, 'getThem'])->name('binhluanbaiviet.them');
Route::post('/binhluanbaiviet/them', [BinhLuanBaiVietController::class, 'postThem'])->name('binhluanbaiviet.them');
Route::get('/binhluanbaiviet/sua/{id}', [BinhLuanBaiVietController::class, 'getSua'])->name('binhluanbaiviet.sua');
Route::post('/binhluanbaiviet/sua/{id}', [BinhLuanBaiVietController::class, 'postSua'])->name('binhluanbaiviet.sua');
Route::get('/binhluanbaiviet/xoa/{id}', [BinhLuanBaiVietController::class, 'getXoa'])->name('binhluanbaiviet.xoa');
Route::get('/binhluanbaiviet/kiemduyet/{id}', [BinhLuanBaiVietController::class, 'getKiemDuyet'])->name('binhluanbaiviet.kiemduyet');
Route::get('/binhluanbaiviet/kichhoat/{id}', [BinhLuanBaiVietController::class, 'getKichHoat'])->name('binhluanbaiviet.kichhoat');

