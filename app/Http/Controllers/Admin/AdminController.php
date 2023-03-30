<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use App\Models\CustomBox;
use App\Models\PageMetaTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    //admin dashboard 
    public function index()
    {
        return view('admin.dashboard');
    }

    //admin profile page frontend
    public function profile()
    {
        return view('admin.profile', ['user' => Auth::user()]);
    }

    //Saving profile data
    public function saveprofile(Request $request)
    {
        //=============================validations on input data start=========================
        $request->validate([
            'name' => 'required|min:3|max:50',
        ]);

        //Validate If user wants to change password
        if (!empty($request->password)) {
            $request->validate([
                'oldpassword' => 'required',
                'password' => 'min:6|confirmed',
            ]);
        }

        if (!empty($request->oldpassword)) {
            $request->validate([
                'password' => 'required',
            ]);
        }

        //Validate If user wants to change profile image
        if (!empty($request->profileimage)) {
            $request->validate([
                'profileimage' => 'image|max:2048|mimes:jpeg,png,jpg',
            ]);
        }

        //=============================validations on input data complete==========================
        $user = User::find(Auth::id()); //getting admin from user table using id
        $user->name = $request->name;

        //Store If user wants to change password
        if (!empty($request->password)) {
            if (Hash::check($request->oldpassword, $user->password)) {   //checking old password of user 
                $user->password = Hash::make($request->password);
            } else {
                return Redirect::route('admin.profile')->withError('Old password is incorrect');  //redirect to profile page if old password is incorrect
            }
        }

        //Saving Profile Image 
        if (!empty($request->profileimage) && $request->profileimage->isValid()) {
            $StoredImagePath = single_image_upload($request->profileimage, 'Adminprofile');      //uploading image in storage/app/Adminprofile using helper function
            if ($StoredImagePath !== 0) {
                $user->profileimg = $StoredImagePath;
            }
        }

        $user->save();
        return Redirect::route('admin.profile')->withSuccess('Profile Updated');
    }
    //Saving profile data complete

    public function Settings($slug = NULL)
    {
        return view('admin.settings.' . $slug);
    }

    //Saving  Settings
    public function SaveSettings(Request $request, $slug)
    {
        foreach ($request->all() as $key => $value) {
            if (!in_array($key, ['_token', 'Settings_Type'], true)) {
                $this->Save_Meta_Tags($request->Settings_Type, $key, $value, $request);
            }
        }
        return Redirect::route('admin.Settings', $slug)->withSuccess('Settings Updated');
    }


    //saving meta tags
    private function Save_Meta_Tags($type, $key, $value, $request)
    {
        $tag = PageMetaTag::where('type', '=', $type)->where('key', '=', $key)->first();
        if ($tag) {
            $file_path = public_path('/storage/' . $tag->value);
        } else {
            $tag = new PageMetaTag;
            $file_path = $type;
        }

        if ($request->hasFile($key)) {
            $file = $request->file($key);
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
            $value = single_image_upload($file, $type);
        }

        $tag->type = $type;
        $tag->key = $key;
        $tag->value = $value;
        $tag->save();
    }
}
