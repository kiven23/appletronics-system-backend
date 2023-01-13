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
class BkScalateController extends Controller
{
   public function index(){

     //  return   $data = BkScalate::with(["threads" => function($q){
     //                      $q->with("fromby");
     //                      }])->get();

        $scalateData = DB::table("bk_scalates")->get();
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
    return $req;
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
            $threads->save();
            return $this->index();
        }else if($req->identify == 1){
            $update = BkScalate::find($req->id);
            $update->categories = $req->category;
            $update->save();
            return $this->index();
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
       return $out;
   }
}
