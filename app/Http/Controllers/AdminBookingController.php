<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class AdminBookingController extends Controller
{
    public function allbooking()
    {
        $alladBooking = Booking::all();

        return view('admin.formbooking.allbooking', compact('alladBooking'));
    }

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
