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
use App\BkScalate;
use App\BkScalateUpdates;
use App\BkNotify as notify; 
class BkScalateController extends Controller
{

   public function notify($id, $logs){
        $getBr = DB::table("bk_scalates")->where("id", $id)->pluck("branch")->first();
        $receiver = \Auth::user()->branch_id !== 5 ? 5: \Auth::user()->branch_id;
        $insert =  new notify;
        $insert->bsender_id = \Auth::user()->branch_id;
        if(\Auth::user()->branch_id == 5){
          $insert->breceiver_id = $getBr;
        }else{
          $insert->breceiver_id = $receiver;
        }
  
        $insert->status = 0;
        $insert->event_id = $id;
        $insert->event_logs = $logs;
        $insert->save();
     
   }
   public function notification(request $req){
    if(@$req->q == 2){
      return $this->index(2, $req->id);    
    }
     $request = BkRequest::select("callid","requestid","installer","installationdate","reason as status")
    ->where("branch", \Auth::user()->branch_id)
    ->where('status', 1)
    ->whereNotNull('notify')->get();
    $receiver = \Auth::user()->branch_id == 5 ? 5: \Auth::user()->branch_id;
    $data = DB::table('bk_notifies')
                             ->select("bk_notifies.created_at",
                                      "bk_notifies.status",
                                      "event_logs",
                                      "name",
                                      "customername",
                                      "categories","bk_notifies.event_id")
                             ->join("branches", "bk_notifies.bsender_id" , "=", "branches.id")
                             ->join("bk_scalates", "bk_notifies.event_id", "=", "bk_scalates.id")
                             ->where('breceiver_id',  $receiver)
                             ->where('bk_notifies.status', 0)
                             ->orderby('bk_notifies.id', 'DESC')
                             ->get();
     $d['count'] =  count($data) + count($request);
     $d['data']= $data;
     $d['notify'] = $request;
    return $d;
    }

   
   public function index($identify =null, $id = null){
       
        
        if($identify == 2){
          $scalateData = DB::table("bk_scalates")->where("id", $id)->get();
          DB::table('bk_notifies')->where("event_id", $id)->where("breceiver_id", \Auth::user()->branch_id)->update([
            'status'=> 1
          ]);
        }else{
          if(\Auth::user()->branch_id == 5){
               $scalateData = DB::table("bk_scalates")->get();
             }else{
               $scalateData = DB::table("bk_scalates")->where("branch", \Auth::user()->branch_id)->get();
             }
        }
        
         
        foreach($scalateData as $data){
            $scalateFData[] = ["data" => $data,
                       "threads" => DB::table("bk_scalate_updates")
                       ->select(\DB::raw("users.first_name as from_bys"),"scalate_id","threads","bk_scalate_updates.created_at as created_at","bk_scalate_updates.updated_at as updated_at" )
                       ->leftJoin("users", "users.id","=", "bk_scalate_updates.from_by")
                       ->where("scalate_id", $data->id)
                       ->get()
                    
                    ];
        }
        return $scalateFData;
     
   }
   public function customerList(Request $req){
        try{

            return  $data = DB::table("bk_requests")
            ->select(\DB::raw("CONCAT(UPPER(lastname), ' ,', UPPER(firstname), ' - ', cpnumber) AS whole"), "bk_customer_infos.id", "lastname", "cpnumber", "callid", "requestid")
            ->join("bk_customer_infos", "bk_requests.customerid", "=", "bk_customer_infos.id")
            ->where("firstname" , "like", "%".$req->q."%")
            ->get();
        }catch(\Exception $e){
            $data = $e;
        }
       
        return $data;
   }
     
   public function create(Request $req){
       
        if($req->identify == 1){
            $create = new BkScalate();
            $create->customername = $req->customerdata['whole'];
            $create->categories = $req->category;
            $create->status = 1;
            $create->branch = \Auth::user()->branch_id;
            $create->requestid = $req->customerdata['requestid'];
            $create->save();
            $threads = new BkScalateUpdates();
            $threads->scalate_id = $create->id;
            $threads->threads = @$req->note;
            $threads->from_by = \Auth::user()->id;
            $threads->save();
            $this->index();
            $this->notify($create->id,  $req->category);
        } if($req->identify == 2){
            $update = BkScalate::find($req->id);
            $update->categories = $req->category;
            $update->update();
            $threads = new BkScalateUpdates();
            $threads->scalate_id = $update->id;
            $threads->threads = 'Update Category to '. $req->category;
            $threads->from_by = \Auth::user()->id;
            $threads->save();

            $out =  DB::table("bk_scalate_updates")
            ->select(\DB::raw("users.first_name as from_bys"),"scalate_id","threads","bk_scalate_updates.created_at as created_at","bk_scalate_updates.updated_at as updated_at" )
            ->leftJoin("users", "users.id","=", "bk_scalate_updates.from_by")
            ->where("bk_scalate_updates.id",  $threads->id)
            ->get();
            $this->index();
            $this->notify($req->id, $threads->threads);   
             return $out;
            
        }
        //UPDATE STATUS TO RESOLVE
        if($req->identify == 3){
            $update = BkScalate::find($req->id);
            $update->status = 2;
            $update->update();
            $threads = new BkScalateUpdates();
            $threads->scalate_id = $update->id;
            $threads->threads = 'System Set to Close Mark as Resolved';
            $threads->from_by = \Auth::user()->id;
            $threads->save();

            $out =  DB::table("bk_scalate_updates")
            ->select(\DB::raw("users.first_name as from_bys"),"scalate_id","threads","bk_scalate_updates.created_at as created_at","bk_scalate_updates.updated_at as updated_at" )
            ->leftJoin("users", "users.id","=", "bk_scalate_updates.from_by")
            ->where("bk_scalate_updates.id",  $threads->id)
            ->get();
            $this->notify($req->id, $threads->threads);   
             return $out;
            
        }
        //UPDATE STATUS TO OPEN PENDING
        if($req->identify == 5){
            $update = BkScalate::find($req->id);
            $update->status = 1;
            $update->update();

            $threads = new BkScalateUpdates();
            $threads->scalate_id = $update->id;
            $threads->threads = 'System Set To Open Mark as PENDING';
            $threads->from_by = \Auth::user()->id;
            $threads->save();

            $out =  DB::table("bk_scalate_updates")
            ->select(\DB::raw("users.first_name as from_bys"),"scalate_id","threads","bk_scalate_updates.created_at as created_at","bk_scalate_updates.updated_at as updated_at" )
            ->leftJoin("users", "users.id","=", "bk_scalate_updates.from_by")
            ->where("bk_scalate_updates.id",  $threads->id)
            ->get();
            $this->notify($req->id, $threads->threads);        
             return $out;
        }
        
        
        
   }
   public function threads(Request $req){
       $threads = new BkScalateUpdates();
       $threads->scalate_id = $req->scalate_id;
       $threads->threads = $req->thread;
       $threads->from_by = \Auth::user()->id;
       $threads->save();
       
       $out =  DB::table("bk_scalate_updates")
                ->select(\DB::raw("users.first_name as from_bys"),"scalate_id","threads","bk_scalate_updates.created_at as created_at","bk_scalate_updates.updated_at as updated_at" )
                ->leftJoin("users", "users.id","=", "bk_scalate_updates.from_by")
                ->where("bk_scalate_updates.id",  $threads->id)
                ->get();
       $this->notify($req->scalate_id, $req->thread);        
       return $out;
   }
   public function scalatecout(){
     if(\Auth::user()->branch_id == 5){
       
          $total['pending'] =  BkScalate::all()->where("status", 1)->count();
          $total['resolved'] =  BkScalate::all()->where("status", 2)->count();
          $total['total'] =  BkScalate::all()->count();
        }else{
          
          $total['pending'] =  BkScalate::all()->where("status", 1)->where("branch", \Auth::user()->branch_id)->count();
          $total['resolved'] =  BkScalate::all()->where("status", 2)->where("branch", \Auth::user()->branch_id)->count();
          $total['total'] =  BkScalate::all()->where("status", 2)->where("branch", \Auth::user()->branch_id)->count();
        }
 
        return  $total;
   }

}
