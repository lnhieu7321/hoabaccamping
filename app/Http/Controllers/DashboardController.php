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
    public function dashboard(Request $request)
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



        $revenueData = Booking::whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })
            ->where('status_book', 'đã duyệt')
            ->selectRaw('DATE_FORMAT(start_date, "%m") as month, SUM(total_cost) as total_revenue')
            ->whereYear('start_date', date('Y'))
            ->groupBy('month')
            ->get();

        $formattedDates = [
            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
            '11',
            '12',
        ];

        $revenues = [];
        foreach ($revenueData as $revenue) {
            $revenues[$revenue->month] = $revenue->total_revenue;
        }

        $ratings = Rating::whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })
            ->get();

        // Khởi tạo mảng để lưu trữ số người đã đánh giá
        $ratingsCount = [
            '5' => 0,
            '4' => 0,
            '3' => 0,
            '2' => 0,
            '1' => 0,
        ];

        // Duyệt qua tất cả các đánh giá
        foreach ($ratings as $rating) {
            // Thêm số người đã đánh giá cho từng mức độ
            $ratingsCount[$rating->rate]++;
        }
        $daduyet = Booking::whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })
            ->where('status_book', 'đã duyệt')  // Thêm điều kiện status_book
            ->count();
        $choduyet = Booking::whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })
            ->where('status_book', 'chờ duyệt')  // Thêm điều kiện status_book
            ->count();
        $tuchoi = Booking::whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })
            ->where('status_book', 'từ chối')  // Thêm điều kiện status_book
            ->count();
        $dahuy = Booking::whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })
            ->where('status_book', 'đã hủy')  // Thêm điều kiện status_book
            ->count();
        /*$bookings = Booking::whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })
            ->get();

        // Khởi tạo mảng để lưu trữ số lượt book
        $bookCounts = [
            'đã duyệt' => 0,
            'chờ duyệt' => 0,
            'từ chối' => 0,
            'đã hủy' => 0,
        ];

        // Duyệt qua tất cả các lượt book
        foreach ($bookings as $booking) {
            // Thêm số lượt book cho từng trạng thái
            switch ($booking->status_book) {
                case 'đã duyệt':
                    $bookCounts['đã duyệt']++;
                    break;
                case 'chờ duyệt':
                    $bookCounts['chờ duyệt']++;
                    break;
                case 'từ chối':
                    $bookCounts['từ chối']++;
                    break;
                case 'đã hủy':
                    $bookCounts['đã hủy']++;
                    break;
            }
        }*/


        return view('business.home.dashboard', compact('totalBookings', 'totalServices', 'totalRatings', 'formattedDates', 'revenues', 'ratingsCount', 'daduyet', 'choduyet', 'tuchoi', 'dahuy'));
    }
}
