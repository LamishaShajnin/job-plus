<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AccountController extends Controller
{
    //registration page
    public function registration(){
        return view('front.account.registration');


    }
//will save a user
    public function processRegistration(Request $request){
        $validator = validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|same:comfirm_password',
            'Confirm_password' => 'required'
        ]); 

        if ($validator->passes()){

        } else{
            return response()->json([
                'status' => false,
                'erros' => $validator->erros()
            ]);

        }
    }

    //login page
    public function login(){
        

    }
}
