<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function allbooking()
    {
        $user = Auth::user();
        $allBookings = Booking::with('customers')->whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })
            ->orderByDesc('id')->get();

        return view('business.formbooking.allbooking', compact('allBookings'));
    }


    // Approve booking
    public function approveBooking(Request $request)
    {
        $ids = $request->route('id');
        $booking = Booking::where('id', $ids)->first();
        if ($booking) {
            $booking->status_book = 'đã duyệt';
            $booking->save();

            Toastr::success('Booking approved successfully :)', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Booking not found :)', 'Error');
            return redirect()->back();
        }
    }


    // Cancel booking
    public function cancelBooking(Request $request)
    {
        $ids = $request->route('id');
        $booking = Booking::where('id', $ids)->first();
        if ($booking) {
            $booking->status_book = 'từ chối';
            $booking->save();

            Toastr::success('Booking approved successfully :)', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Booking not found :)', 'Error');
            return redirect()->back();
        }
    }
}
