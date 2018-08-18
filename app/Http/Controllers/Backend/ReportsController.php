<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reports;
use App\User;
use App\Models\Posts;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Support\Facades\Input;

class ReportsController extends Controller
{
    public function createReport(Request $request)
    {
    	$input = $request->all();
        $getReports = Reports::where('category',$input['category'])->where('fk_user_id',$input['fk_user_id'])->where('report_type_id',$input['report_type_id'])->first();

    	try {
            if(count($getReports)>0){
                return "exist";
            }else{
                Reports::create($input);
                return "success";  
            }
    		
    	} catch (\Exception $e) {
    		return "error";
    	}
    }
    public function unique_multidim_array($array, $key) { 
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 
        
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
        return $temp_array; 
    }

    public function userReport()
    {
        $status = 0;
        return view('backend.reports.users.user-report', compact('status'));
    }

    public function userReportReview()
    {
        $status = 1;
        return view('backend.reports.users.user-report', compact('status'));
    }
    public function userReportBlock()
    {
        $status = 2;
        return view('backend.reports.users.user-report', compact('status'));
    }
    public function userReportView($status)
    {
        
        if($status == 0){

            $report = Reports::where('type','user')->where('status',0)->orderBy('created_at','desc')->get();
        }elseif($status == 1){

            $report = Reports::where('type','user')->where('status',1)->orderBy('created_at','desc')->get();
        }elseif($status == 2){

            $report = Reports::where('type','user')->where('status',2)->orderBy('created_at','desc')->get();
        }
        
        $getUser = $this->unique_multidim_array($report,'report_type_id'); 

        return Datatables::of($getUser)
           
            ->editColumn('username', function($getUser){
                
             return $getUser->report_users['fullname'];
            })
            ->editColumn('reported_by', function($getUser){
                
             return $getUser->users['fullname'];
            })
            ->editColumn('report_count', function($getUser){
                
             return Reports::where('report_type_id',$getUser['report_type_id'])->count();
            })

            
            ->addColumn('action', '
                <div class="btn-group">

                    <a target="_blank" href=\'{{URL::to("user-single-report-details/$report_type_id")}}\' class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                    
                </div>
                ')
            ->make(true);
    }

    public function userSingleReport($id)
    {
        $getReports = Reports::where('report_type_id',$id)->orderBy('created_at','desc')->get();
        //return $getReports;
        return view('backend.reports.users.single-user-report', compact('getReports'));
    }

    public function confirmReview(Request $request, $id)
    {
        $input = $request->all();
       
        $getReports = Reports::checkReport($input['type'], $id);

        if($input['status'] == 0){
            $status = 1;
        }else{
            $status = 0;
        }
        $reportCount = count($getReports);
        for ($i=0; $i < $reportCount; $i++) { 
           $getReport = Reports::findOrFail($getReports[$i]['_id']);
           $getReport->update(['status'=> $status]);
        }
        return 'success';
    }

    public function postReport()
    {
        $status = 0;
        return view('backend.reports.posts.post-report', compact('status'));
    }
    public function postReportReview()
    {
        $status = 1;
        return view('backend.reports.posts.post-report', compact('status'));
    }
    public function postReportBlock()
    {
        $status = 2;
        return view('backend.reports.posts.post-report', compact('status'));
    }
    public function postReportView($status)
    {
        if($status == 0){

            $report = Reports::where('type','post')->where('status',0)->orderBy('created_at','desc')->get();
        }elseif($status == 1){

            $report = Reports::where('type','post')->where('status',1)->orderBy('created_at','desc')->get();
        }elseif($status == 2){

            $report = Reports::where('type','post')->where('status',2)->orderBy('created_at','desc')->get();
        }
        
        $getPost = $this->unique_multidim_array($report,'report_type_id'); 

        return Datatables::of($getPost)
           
            ->editColumn('description', function($getPost){
                
             return $getPost->report_post['description'];
            })
            ->editColumn('reported_by', function($getPost){
                
             return $getPost->users['fullname'];
            })
            ->editColumn('report_count', function($getPost){
                
             return Reports::where('report_type_id',$getPost['report_type_id'])->count();
            })

            
            ->addColumn('action', '
                <div class="btn-group">

                    <a target="_blank" href=\'{{URL::to("post-single-report-details/$report_type_id")}}\' class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                    
                </div>
                ')
            ->make(true);
    }

    public function postSingleReport($id)
    {
        $getReports = Reports::where('report_type_id',$id)->orderBy('created_at','desc')->get();
        //return $getReports;
        return view('backend.reports.posts.single-post-report', compact('getReports'));
    }
}
