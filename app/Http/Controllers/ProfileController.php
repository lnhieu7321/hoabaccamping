<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Businesse;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

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

            User::where('id', $request->id)->update($userUpdate);


            /*$business = Businesse::where('users_id', $request->id)->first();

            if ($request->hasFile('image')) {
                // Handle image update
                $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
                    'folder' => 'logo',
                ])->getSecurePath();

                // Check if an existing image record exists for this service


                // If there is a business record, update it
                if ($business) {
                    // Upload logo to Cloudinary

                    // Update the business record
                    $businessUpdate = [
                        'business_name' => $request->business_name,
                        'logo' => $uploadedFileUrl,
                        'address' => $request->address,
                        'ward' => $request->ward,
                        'district' => $request->district,
                        'city' => $request->city,
                    ];

                    $business->update($businessUpdate);
                } else {
                    // If there is no business record, create a new one
                    $business = new Businesse();
                    $business->users_id = $request->id;
                    $business->business_name = $request->business_name;
                    $business->logo = $uploadedFileUrl;
                    $business->address = $request->address;
                    $business->ward = $request->ward;
                    $business->district = $request->district;
                    $business->city = $request->city;

                    $business->save();
                }
            }*/

            DB::commit();
            Toastr::success('Updated user and business information successfully!', 'Success');
            return redirect()->route('/dashboard');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Update failed. Please try again.', 'Error');
            return redirect()->back();
        }
    }



    /**
     * Update the user's profile information.
     */
}
