<?php

namespace App\Http\Controllers;

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
                
                // CRITICAL: Regenerate session to fix the "logged out" redirect bug
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
        
        $user = User::where('id',$id)->first();
        
        return view('front.account.profile',[
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request){
        $id = Auth::user()->id;


        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5|max:20',
            //table,col,exception,id
            'email' => 'required|email|unique:users,cemail,'.$id.',id'
        ]);

        if ($validator->passes()){
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
        }else{
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

        // Fully clear the session to prevent "ghost" sessions
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('account.login')->with('success', 'You have been logged out.');
    }
}