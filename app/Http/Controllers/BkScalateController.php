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
class BkScalateController extends Controller
{
   public function index(){
        return BkScalate::all();
   }
   public function customerList(Request $req){
        try{

            return  $data = DB::table("bk_requests")
            ->select(\DB::raw("CONCAT(UPPER(lastname), ' ,', UPPER(firstname), ' - ', cpnumber) AS whole"), "bk_customer_infos.id", "lastname", "cpnumber", "callid")
            ->join("bk_customer_infos", "bk_requests.customerid", "=", "bk_customer_infos.id")
            ->where("firstname" , "like", "%".$req->q."%")
            ->get();
        }catch(\Exception $e){
            $data = $e;
        }
       
        return $data;
   }
}
