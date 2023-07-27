<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Requests\CreateJobsRequest;
use App\Http\Requests\UpdatejobRequest;
use App\Models\JobsFile;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public function index()
    {
        //eloquent model
        //$data=Job::select('*')->orderby('id','ASC')->paginate(6);
        //quey builder
        // $data=DB::table('jobs')->paginate(6);
        // $data=DB::table('jobs')->get();
        $data=get_cols_where_p(new Job(),array('*'),
        array('active'=>1),'id','DESC',5);
        if(!empty($data)){
            foreach($data as $info){
                $info->files=get_cols_where(new JobsFile(), array("*"), array("jobsid"=>$info->id));
            }
        }

        return view('jobs',['data'=>$data]);
    }
    public function create()
    {        return view('create');    }
    public function store(CreateJobsRequest $request)
    {
         $datatoinsert['name']=$request->job_name;
         $datatoinsert['active']=$request->job_active;
         $datatoinsert['created_at']=date('Y-m-d H:i:s');
         
            $flage=insert(new job(),$datatoinsert);
            if($flage){
                $parentjob=get_cols_where_row(new job,array("id"),$datatoinsert);
                    if(!empty($parentjob)){
                        if($request->has('photo')){
                            foreach($request->photo as $image){
                                $datatoinsert['photo']=upload("upload",$image);
                                $datatoinsert['created_at']=date("Y-m-d H:i:s");
                                $datatoinsert['jobs_id']=$parentjob['id'];
                                insert(new JobsFile(),$datatoinsert);

                            }
                        }
                    }
            }
         return redirect()->route('index')->with(
            ['success'=>'added successfully']
       
            //  if($request->has('photo')){
        //     $datatoinsert['photo']=upload("upload",$request->photo);
        //  }
         // if($request->has('photo')){
        //     $image=$request->photo;
        //     $extinsion=strtolower($image->extension());
        //     $filename=time().rand(1,10000).".".$extinsion;
        //     $image->move("uploads",$filename);
        //     $datatoinsert['photo']=$filename;
        // }
       
        );
    }
    public function edit($id)
    { 
        // $data=Job::select('*')->find($id);  //eloquent model
        // $data=DB::table('jobs')->find($id);     //query builder.
        $data=get_cols_where_row(new Job(),array("*"),array("id"=>$id));
        return view('edit',['data'=>$data]);
    }
    public function update($id,UpdatejobRequest $request)
    {
       $dataToUpdate['name'] =$request->job_name;
       $dataToUpdate['active'] =$request->job_active;
       $dataToUpdate['created_at'] =date('Y-m-d H:i:s');
        // Job::where(['id'=>$id])->update($dataToUpdate);
        // DB::table('jobs')->where('id',$id)->update($dataToUpdate);
        update(new Job(),$dataToUpdate,array("id"=>$id));
        return redirect()->route('index')->with(
            ['success'=>'updated successfully']
        );
    }
    public function destroy($id)
    {
        // Job::where(['id'=>$id])->delete();
        // DB::table('jobs')->where('id',$id)->delete();
        delete(new Job(),array("id"=>$id));
        return redirect()->route('index')->with(
            ['success'=>'deleted successfully']
        );
    }
    public function ajax_search(Request $request)
    {
        if($request->ajax()){
            $searchbyjobname=$request->searchbyjobname;
            $data=Job::where("name","like","%{$searchbyjobname}%")
            ->orderby("id","ASC")->paginate(10);
            return view('ajax_search',['data'=>$data]);
        }
    }

    public function get_all_jobs()
    {
        $data=get_cols_where_p(new Job(), array('*'),array(),'id','DESC',5);
        return response()->json($data);
    }
    public function createjob_api(CreateJobsRequest $request)
    {
        $datatoinsert['name']=$request->job_name;
        $datatoinsert['active']=$request->job_active;
        $datatoinsert['created_at']=date('Y-m-d H:i:s');
        
           $flage=insert(new job(),$datatoinsert);
           if($flage){
            $response=array('code'=>200, "message"=>"created successfully");
           } else {
            $response=array("code"=>401,"message"=>"error");
           }
           return response()->json($response);
    }
}
