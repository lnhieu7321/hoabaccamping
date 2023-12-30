<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Businesse;
use App\Models\Rating;
use App\Models\Service;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{


    public function showLoginForm()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $gender = $request->input('flexRadioDefault');
        if (Auth::attempt($credentials) && auth()->user()->role == 'admin' && $gender == 'admin') {
            // Đăng nhập thành công
            if (auth()->user()->statuses_id  == '1') {
                return redirect()->intended('/admindashboard');
            } else {
                return redirect()->route('admin.login')->with('error', 'Đăng nhập không thành công. Tài khoản của bạn đã bị tạm khóa liên hệ quản trị để được mở lại.');
            }


            // Đổ thông tin người dùng vào biến thể view


        } elseif (Auth::attempt($credentials) && auth()->user()->role == 'business' && $gender == 'business') {

            if (auth()->user()->statuses_id  == '1') {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->route('admin.login')->with('error', 'Đăng nhập không thành công. Tài khoản của bạn đã bị tạm khóa liên hệ quản trị để được mở lại.');
            }
        }

        // Đăng nhập không thành công
        return redirect()->route('admin.login')->with('error', 'Đăng nhập không thành công. Vui lòng kiểm tra thông tin đăng nhập của bạn.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}
