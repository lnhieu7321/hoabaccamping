<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Businesse;
use App\Models\Rating;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalBookings = Booking::whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })->count();

        $business = Businesse::where('users_id', Auth::user()->id)->first();
        $totalServices = Service::with('images')
            ->whereHas('businesses', function ($query) use ($business) {
                return $query->where('id', $business->id);
            })
            ->count();

        $totalRatings = Rating::with('customers', 'bookings')->whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })->count();



        // Lấy doanh thu theo tháng
        $revenueData = Booking::whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })
            ->where('status_book', 'approved')
            ->selectRaw('DATE_FORMAT(start_date, "%Y-%m") as month, SUM(total_cost) as total_revenue')
            ->groupBy('month')
            ->get();

        // Chuyển định dạng ngày để hiển thị trên biểu đồ
        $formattedDates = json_encode($revenueData->pluck('month')->map(function ($date) {
            return Carbon::createFromFormat('Y-m', $date)->format('M Y');
        }));

        // Lấy doanh thu từ kết quả query
        $revenues = json_encode($revenueData->pluck('total_revenue'));

        return view('business.home.dashboard', compact('totalBookings', 'totalServices', 'totalRatings', 'formattedDates', 'revenues'));
    }
}
