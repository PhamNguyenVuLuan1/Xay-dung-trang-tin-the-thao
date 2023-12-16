<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getDanhSach()
    {
        $user = User::all();
        return view('admin.user.danhsach', ['user' => $user]);
    }
    public function getThem()
    {
        return view('admin.user.them');
    }
    public function postThem(Request $request)
    {
        // kiểm tra thông tin
        // required - bắt buộc nhập; email- phải là địa chỉa email; string - kiểu chuổi; min:4 - nhỏ nhất là 4; confirmed - xác nhận lại thông tin (ví dụ: mật khẩu)
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);
        $orm = new User();
        $orm->name = $request->name;$orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->password = Hash::make($request->password);
        $orm->role = $request->role;
        $orm->save();
        return redirect()->route('admin.user');
        }
    public function getSua($id)
    {
        $user = User::find($id);
        return view('admin.user.sua', ['user' => $user]);
    }
    public function postSua(Request $request)
    {
        // kiểm tra thoong tin
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
            'role' => ['required'],
            'password' => ['confirmed'],
        ]);

        $orm = User::find($request->id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->role = $request->role;
        if(!empty($request->password)) $orm->password = Hash::make($request->password);
        $orm->save();
        // sau khi sửa thành công thì tự động chuyển về
        return redirect()->route('admin.user');
    }
    public function getXoa($id)
    {
        $orm = User::find($id);
        $orm->delete();
        return redirect()->route('admin.user');
    }
    
}
