<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //will show home page
    public function index(){
        return view('front.home');
    }
}
