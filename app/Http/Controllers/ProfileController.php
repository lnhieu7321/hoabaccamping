<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Admin;
use App\Models\Businesse;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;






use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function useredit(Request $request): View
    {
        $user = Auth::user();
        $business = Businesse::where('users_id', Auth::user()->id)->first();
        return view('business.profile.edit', compact('user', 'business'));
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

            $business = Businesse::where('users_id', Auth::user()->id)->first();

            if ($request->hasFile('image')) {
                $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
                    'folder' => 'logo',
                ])->getSecurePath();

                $business->logo = $uploadedFileUrl;
            }

            $business->business_name = $request->business_name;
            $business->address = $request->address;
            $business->ward = $request->ward;
            $business->district = $request->district;
            $business->city = $request->city;
            $business->fanpage_url = $request->fanpage_url;
            $business->website_url = $request->website_url;

            $business->save();


            DB::commit();
            Toastr::success('Updated successfully!', 'Success');

            return redirect()->route('dashboard')->with('toastr', [
                'type' => 'success',
                'message' => 'Updated user and business information successfully!',
                'title' => 'Success'
            ]);
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
        return view('business.profile.changePassword');
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
            return redirect()->route('dashboard');
        } else {

            Toastr::error('Update failed. Please try again.', 'Error');
            return redirect()->back();
        }
    }
}
