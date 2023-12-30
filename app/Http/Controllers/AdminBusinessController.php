<?php

namespace App\Http\Controllers;

use App\Models\Businesse;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdminBusinessController extends Controller
{
    public function allbusiness()
    {

        $allbusinesses = User::with("businesses", "user_statuses")
            ->where('role', 'business')
            ->get();

        return view('admin.formbusiness.allbusiness', compact('allbusinesses'));
    }

    public function approveBusiness(Request $request)
    {
        $ids = $request->route('id');
        $business = User::where('id', $ids)->first();
        if ($business) {
            $business->statuses_id  = '1';
            $business->save();

            Toastr::success(' approved successfully :)', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('not found :)', 'Error');
            return redirect()->back();
        }
    }


    // Cancel booking
    public function cancelBusiness(Request $request)
    {
        $ids = $request->route('id');
        $business = User::where('id', $ids)->first();
        if ($business) {
            $business->statuses_id  = '2';
            $business->save();

            Toastr::success('approved successfully :)', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('not found :)', 'Error');
            return redirect()->back();
        }
    }

    public function businessAdd()
    {

        $user = DB::table('users')->get();
        return view('admin.formbusiness.businessadd', compact('user'));
    }

    // service edit


    // service save record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:100',
            'email'     => 'required|string',
            'phone' => 'required|string',
            'business_name' => 'required|string',
            'address' => 'required|string|max:200',
            'ward' => 'required|string|max:100',
            'district'  => 'required|string|max:100',
            'city' => 'required|string|max:100',

        ]);


        DB::beginTransaction();
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email     = $request->email;
            $user->phone  = $request->phone;
            $user->password = 'abcd1234';
            $user->role = 'business';
            $user->statuses_id = '1';

            $user->save();


            $business = new Businesse;
            $business->business_name = $request->business_name;
            $business->address  = $request->address;
            $business->ward  = $request->ward;
            $business->district   = $request->district;
            $business->city  = $request->city;
            $business->users_id = $user->id;
            $business->save();

            DB::commit();
            Toastr::success('Create new service successfully :)', 'Success');
            return redirect()->route('form/allbusiness');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add service fail :)', 'Error');
            return redirect()->back();
        }
    }
}
