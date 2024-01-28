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
        $onestar = DB::table("ratings")->where("rate", 1)->count();
        $twostar = DB::table("ratings")->where("rate", 2)->count();
        $therestar = DB::table("ratings")->where("rate", 3)->count();
        $fourstar = DB::table("ratings")->where("rate", 4)->count();
        $fivestar = DB::table("ratings")->where("rate", 5)->count();

        $revenueData = Booking::where('status_book', 'đã duyệt')
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

        $bookings = DB::table('bookings')
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
        }

        return view('admin.home.admindashboard', compact('user_count', 'totalBookings', 'totalServices', 'totalRatings', 'bookCounts', 'formattedDates', 'revenues', 'onestar', 'twostar', 'therestar', 'fourstar', 'fivestar'));
    }
}
