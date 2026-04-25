<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //will show home page
    public function index(){
        $categories = Category::where('status',1)->orderBy('name','ASC')->take(8)->get();
        return view('front.home',[
            'categories'=>$categories
        ]);
    }
}
