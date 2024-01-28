<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use Barryvdh\DomPDF\PDF;
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

    public function search(Request $request)
    {
        $search_text = $_GET['query'] ?? '';

        $alladBooking = Booking::where(function ($query) use ($search_text) {
            $query->where('id', 'like', '%' . $search_text . '%');
        })

            ->orderByDesc('id')->get();


        return view('admin.formbooking.allbooking', compact('alladBooking'));
    }

    public function deleteRecord($id)
    {

        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'message' => 'Vé không tồn tại.',
            ], 404);
        }


        //delete rating
        $ratings = Rating::where('bookings_id', $booking->id)->get();

        foreach ($ratings as $rating) {
            $rating->delete();
        }

        $booking->delete();



        Toastr::success('Xóa đặt vé thành công :)', 'Thành công');
        return redirect()->route('form/adallbooking');
    }
}
