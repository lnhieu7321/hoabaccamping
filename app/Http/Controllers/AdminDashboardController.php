<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AdminDashboardController extends Controller
{
    public function showDashBoard()
    {


        $user_count = User::count();
        $totalBookings =  Booking::count();
        $totalServices =  Service::count();
        $totalRatings = Rating::count();
        $cancel_book = Booking::where('status_book', 'từ chối')->count();
        $approved = Booking::where('status_book', 'đã duyệt')->count();
        $pends = Booking::where('status_book', 'chờ duyệt')->count();

        return view('admin.home.admindashboard', compact('user_count', 'totalBookings', 'totalServices', 'totalRatings', 'cancel_book', 'approved', 'pends'));
    }
}
