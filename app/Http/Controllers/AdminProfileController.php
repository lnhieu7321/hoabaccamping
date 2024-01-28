<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminProfileController extends Controller
{
    public function useredit(Request $request): View
    {
        $user = Auth::user();
        $admin = Admin::where('users_id', Auth::user()->id)->first();
        return view('admin.profile.edit', compact('user', 'admin'));
    }

    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            // Update the users table
            $userUpdate = [
                'id' => Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ];

            User::where('id', Auth::user()->id)->update($userUpdate);

            $admin = Admin::where('users_id', Auth::user()->id)->first();

            if ($request->hasFile('image')) {
                $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
                    'folder' => 'logo',
                ])->getSecurePath();

                $admin->logo = $uploadedFileUrl;
            }

            $admin->admin_name = $request->admin_name;

            $admin->save();


            DB::commit();
            Toastr::success('Updated user and business information successfully!', 'Success');
            return redirect()->route('admin.dashboard');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Update failed. Please try again.', 'Error');
            return redirect()->back();
        }
    }

    //đổi pass
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.profile.changePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if ($currentPasswordStatus) {

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            Toastr::success('Updated user and business information successfully!', 'Success');
            return redirect()->route('admin.dashboard');
        } else {

            Toastr::error('Update failed. Please try again.', 'Error');
            return redirect()->back();
        }
    }
}
