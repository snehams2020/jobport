<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use DataTables;
use App\Models\Job;
use App\Models\JobType;
use App\Models\Emirate;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use File;


class jobController extends Controller {

    private $inputData;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $emirates=Emirate::get();
        $jobtype=JobType::get();
        return Datatables::of(Job::query())
        ->addColumn('status', function ($row) {
           return ($row->status=='1')?'Active':"Inactive";
        })
        ->addColumn('emirates', function ($row) {
            $emirates=Emirate::get();

            foreach($emirates as $val){
                if($val->id==$row->emirates)
                return $val->title;


            }
         })
         ->addColumn('job_type', function ($row) {
            $jobtype=JobType::get();

            foreach($jobtype as $val){
                if($val->id==$row->job_type)
                return $val->title;


            }
         })
        ->addColumn('action', function($row){
            $actionBtn = '
            <a href="'.route('view', ['id' => encrypt($row->id)]).'" 
            class=" btn btn-primary btn-sm">View</a>
            <a href="'.route('edit', ['id' => encrypt($row->id)]).'"
             class="edit btn btn-success btn-sm">Edit</a> 
             <a href="'.route('delete-job', ['id' => encrypt($row->id)]).'" 
             class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);  
    }
    public function create()
    {
        return view('jobs.index');
    }
    public function createJob(){
        $emirates=Emirate::get();
        $jobtype=JobType::get();
        return view('jobs.create',['emirates'=>$emirates,'jobtype'=>$jobtype]);


    }
    public function edit($id){
        $id=decrypt($id);

        $emirates=Emirate::get();
        $jobtype=JobType::get();
        $jobs=Job::where('id',$id)->first();
        return view('jobs.edit',['emirates'=>$emirates,'jobtype'=>$jobtype,'jobs'=>$jobs]);


    }
    public function addJob(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image'=> 'required|mimes:jpg,jpeg,png,jfif',
        ]);
    
        $insert=Job::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'emirates'=>$request->emirates,
            'location'=>$request->location,
            'company_name'=>$request->company,
            'job_type'=>$request->job_type,
            'till_date'=>date('Y-m-d',strtotime($request->till_date)),
            'description'=>$request->description,
            'status'=>'1',



        ]);
        if($request->hasFile('image') && $insert) {
            $fileName_image = Str::random(40).'.'.$request->file('image')->getClientOriginalExtension();
            $path_image = Storage::disk('public')->putFileAs('job-images',$request->file('image'),$fileName_image);
            Job::where('id', $insert->id)->update(['image'=> $fileName_image]);
        }
     
        return redirect()->route('create')
                        ->with('success','Job created successfully.');


    }
    public function editJob(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image'=> 'mimes:jpg,jpeg,png,jfif',

        ]);
    
        Job::where('id',$request->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'emirates'=>$request->emirates,
            'location'=>$request->location,
            'company_name'=>$request->company,
            'job_type'=>$request->job_type,
            'till_date'=>date('Y-m-d',strtotime($request->till_date)),
            'description'=>$request->description,
            'status'=>'1',



        ]);
        if($request->hasFile('image')) {
            $fileName_image = Str::random(40).'.'.$request->file('image')->getClientOriginalExtension();
            $path_image = Storage::disk('public')->putFileAs('job-images',$request->file('image'),$fileName_image);
            Job::where('id', $request->id)->update(['image'=> $fileName_image]);
      
        }

     
        return redirect()->route('create')
                        ->with('success','Job updated successfully.');


    }
    public function deleteJob($id){
        $id=decrypt($id);
        $delete=Job::where('id',$id)->delete();
        return redirect()->route('create')
        ->with('success','Job deleted successfully.');


    }
    public function ViewJob($id){
        $id=decrypt($id);

        $emirates=Emirate::get();
        $jobtype=JobType::get();
        $jobs=Job::where('id',$id)->first();
        return view('jobs.show',['emirates'=>$emirates,'jobtype'=>$jobtype,'jobs'=>$jobs]);



    }


   
    
}
