<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index(){
        $categories = Category::where('status',1)->get();
        $jobTypes = JobType::where('status',1)->get();

        $jobs = Job::where('status',1);

        //search using keywords
        if (!empty($request->keyword)){
            $jobs = $jobs->where(function($query) use($request){
                $query->orWhere('title','like','%'.$request->keyword.'%');
                $query->orWhere('keywords','like','%'.$request->keyword.'%');
            });
        }

        //search using location
        if(!empty($request->location)){
            $jobs = $jobs->where('location',$request->location);

        }

         //search using category
        if(!empty($request->category)){
            $jobs = $jobs->where('category_id',$request->category);

        }

        
         //search using jobType
        if(!empty($request->jobType)){

            $jobTypeArray= explode(',', $request->jobType);
            $jobs = $jobs->where('job_type_id',$jobTypeArray);

        }

        //search using experience
        if(!empty($request->experience)){
            $jobs = $jobs->where('experience',$request->experience);

        }


        $jobs = $jobs->with(['jobType','category'])->orderBy('created_at','DESC')->paginate(9);

        return view('front.jobs',[
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'jobs' => $jobs,
        ]);
    }
}
