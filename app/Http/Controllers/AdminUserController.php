<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Models\Businesse;
use App\Models\Customer;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Google\Cloud\Storage\StorageClient;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminUserController extends Controller
{

    public function alluser()
    {

        $allcustomers = User::with("customers", "user_statuses")
            ->where('role', 'customer')
            ->get();

        return view('admin.formuser.alluser', compact('allcustomers'));
    }

    // service add
    public function userAdd()
    {

        $user = DB::table('users')->get();
        return view('admin.formuser.useradd', compact('user'));
    }

    // service edit


    // service save record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:100',
            'email'     => 'required|string',
            'phone' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
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
            $user->role = 'customer';
            $user->statuses_id = '1';

            $user->save();


            $customer = new Customer;
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->address  = $request->address;
            $customer->ward  = $request->ward;
            $customer->district   = $request->district;
            $customer->city  = $request->city;
            $customer->users_id = $user->id;
            $customer->save();

            DB::commit();
            Toastr::success('Create new service successfully :)', 'Success');
            return redirect()->route('form/alluser');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add service fail :)', 'Error');
            return redirect()->back();
        }
    }

    // update record


    // delete record service


    public function approveCustomer(Request $request)
    {
        $ids = $request->route('id');
        $customer = User::where('id', $ids)->first();
        if ($customer) {
            $customer->statuses_id  = '1';
            $customer->save();

            Toastr::success(' approved successfully :)', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('not found :)', 'Error');
            return redirect()->back();
        }
    }


    // Cancel booking
    public function cancelCustomer(Request $request)
    {
        $ids = $request->route('id');
        $customer = User::where('id', $ids)->first();
        if ($customer) {
            $customer->statuses_id  = '2';
            $customer->save();

            Toastr::success('approved successfully :)', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('not found :)', 'Error');
            return redirect()->back();
        }
    }
}
