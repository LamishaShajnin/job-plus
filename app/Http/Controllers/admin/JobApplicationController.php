<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index(){
        $applications=JobApplication::orderBy('created_at','DESC')
                          ->with('job','user','employer')
                          ->paginate(10);
    
        return view('admin.job_applications.list',[
            'applications' => $applications
        ]);
    }

    public function destroy(Request $request){
        $id = $request->id;

    $jobApplication = JobApplication::find($id);

    if ($jobApplication == null){
        session()->flash('error', 'Either job application deleted or not found');
        
        // Check if AJAX request
        if ($request->ajax()) {
            return response()->json(['status' => false, 'message' => 'User not found']);
        }
        
        return redirect()->route('admin.users')->with('error', 'Job application not found');
    }

    $jobApplication->delete();
    session()->flash('success', 'job application deleted successfully');
    
    // Check if AJAX request
    if ($request->ajax()) {
        return response()->json(['status' => true, 'message' => 'job application deleted successfully']);
    }
    
    return redirect()->route('admin.jobApplications')->with('success', 'Job application deleted successfully');
    
    }
}
