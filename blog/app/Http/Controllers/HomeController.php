<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Str;
use Dotenv\Validator as DotenvValidator;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Form validation
        $request->validate([
            'name'              =>  'required',
            'profile_image'     =>  'image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'sometimes|string|min:6|confirmed|nullable',
        ]);

        // Get current user
        $user = User::findOrFail(auth()->user()->id);
        // Set user name
        $user->name = $request->input('name');

        if(!empty($request->input('password')))
        {
            $user->password = bcrypt($request->input('password'));
        }

        // Check if a profile image has been uploaded
        if ($request->has('profile_image')) {
            // Get image file
            $img = $request->file('profile_image');
            // Make an image name based on user name and current timestamp
            $name = Str::slug($request->input('name')) . '_' . time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $img->getClientOriginalExtension();
            //Transform to Image type
            $image = Image::make($img);
            // Get Watermark
            $watermark = Image::make(public_path('/images/watermark.png'));
            // Insert watermark onto image
            $image->resize(300, 300)->insert($watermark, 'bottom-right', 10, 10)->save(public_path($filePath));
            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;
        }
        // Persist user record to database
        $user->save();

        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }

    public function userDelete(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        $user->delete();

        return redirect('')->with('message', 'Account deleted.');;
    }
}
