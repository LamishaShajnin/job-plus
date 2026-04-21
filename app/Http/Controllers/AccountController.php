<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    // Show registration page
    public function registration()
    {
        return view('front.account.registration');
    }

    // Process registration (AJAX)
    public function processRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success', 'You have registered successfully');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    // Show login page
    public function login()
    {
        return view('front.account.login');
    }

    // Process Login
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                
                // Regenerate session to prevent fixation attacks
                $request->session()->regenerate();

                return redirect()->intended(route('account.profile'));
            } else {
                return redirect()->route('account.login')->with('error', 'Either Email/Password is incorrect');
            }
        } else {
            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    // Show profile (Protected by 'auth' middleware)
    public function profile()
    {
        
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        
        return view('front.account.profile', [
            'user' => $user
        ]);
    }

    // Update Profile logic (AJAX)
    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            // Corrected: unique check on 'email' column, ignoring the current user's ID
            'email' => 'required|email|unique:users,email,'.$id.',id'
        ]);

        if ($validator->passes()) {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->save();

            session()->flash('success', 'Profile updated successfully');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    // Process Logout
    public function logout()
    {
        Auth::logout();

        // Clear session data
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('account.login')->with('success', 'You have been logged out.');
    }

    public function updateProfilePic(Request $request){
        $id = Auth::user()->id;
        $validator = validator::make($request->all(),[
            'image' => 'required|image'

        ]);

        if ($validator->passes()){
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $id.'-'.time().'.'.$ext;  //id-34326778.png
            $image->move(public_path('/profile_pic/'),$imageName);

            User::where('id',$id)->update(['image'=>$imageName]);

            session()->flash('success','Profile picture updated successfully');
            
            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        }else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function createJob(){
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        return view('front.account.job.create',[
            'categories' => $categories
        ]);
    }
}