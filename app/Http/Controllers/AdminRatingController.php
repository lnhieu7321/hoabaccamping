<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class AdminRatingController extends Controller
{
    public function allrating()
    {
        $alladRatings = Rating::with('customers', 'bookings')->get();

        return view('admin.formrating.allrating', compact('alladRatings'));
    }
    public function deleteRecord(Request $request, $id)
    {

        $rating = Rating::find($id);

        if (!$rating) {
            return response()->json([
                'message' => 'Đánh giá không tồn tại.',
            ], 404);
        }


        $rating->delete();

        Toastr::success('Xóa bảng đánh giá thành công :)', 'Thành công');
        return redirect()->route('form/adallrating');
    }
}
