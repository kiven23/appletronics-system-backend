<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use App\BkRequest;
use App\BkUnits;
use App\BkCustomerInfo;
use App\BkCustomerHistory;
use App\BkJobsUpdate;

class BkJobsUpdateController extends Controller
{
 
   public function jobsupdate(request $req){
  
       try {
  
        $updates = new BkJobsUpdate;
        $updates->avatar = '/logo.jpg';
        $updates->user = '@'.\Auth::user()->first_name;
        //reason
        $updates->title = $req->data['reason'];
        //update
        $updates->subtitle = $req->data['updates'];
        $updates->requestid = $req->data['requestID'];
        $updates->save();
        //FETCH
        $msg = ["msg"=> 'Sent Success..!', "error"=> 'success'];
        $DATA = DB::table("bk_jobs_updates")->where("requestid", $req->data['requestID'])->get();
        
        return response()->json($DATA);
      }catch(\Exception $e){
        $msg = ["msg"=>  $e, "error"=> 'error'];
       }
   }
}
