<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use App\BkRequest;
use App\BkUnits;
use App\BkCustomerInfo;
use App\BkCustomerHistory;
use hash;
use App\user;
 
class BkRequestController extends Controller
{
    public function history($req){
        if($req->cpnumber){
            $check = BkCustomerHistory::where("cpnumber", $req->cpnumber)->pluck('id')->first();
            if(!$check){
                $CustomerDATA = new BkCustomerHistory();
                $CustomerDATA->firstname =  @$req->firstname;
                $CustomerDATA->lastname  = @$req->lastname;
                $CustomerDATA->middlename  = @$req->middlename;
                $CustomerDATA->barangay  = @$req->barangay;
                $CustomerDATA->contactperson = @$req->contactperson;
                $CustomerDATA->cpnumber = @$req->cpnumber;
                $CustomerDATA->emailaddress = @$req->emailaddress;
                 
                $CustomerDATA->houseno = @$req->houseno;
                $CustomerDATA->mcity = @$req->mcity;
                $CustomerDATA->organization = @$req->organization;
                $CustomerDATA->province = @$req->province;
                $CustomerDATA->specialinstruction = @$req->specialinstruction;
                $CustomerDATA->street = @$req->street;
                $CustomerDATA->telephoneno = @$req->telephoneno;
                $CustomerDATA->save();
            }
        }
       return "OK";
    }
    public function store(request $req){
         
        $checkData = BkRequest::where('requestid', $req->requestid)->pluck('requestid')->first();
        //CUSTOMER
         
        try{
            if(!$checkData){
                $CustomerDATA = new BkCustomerInfo();
                $CustomerDATA->firstname =  @$req->firstname;
                $CustomerDATA->lastname  = @$req->lastname;
                $CustomerDATA->middlename  = @$req->middlename;
                $CustomerDATA->barangay  = @$req->barangay;
                $CustomerDATA->contactperson = @$req->contactperson;
                $CustomerDATA->cpnumber = @$req->cpnumber;
          
                $CustomerDATA->emailaddress = @$req->emailaddress;
                $CustomerDATA->houseno = @$req->houseno;
                $CustomerDATA->mcity = @$req->mcity;
                $CustomerDATA->organization = @$req->organization;
                $CustomerDATA->province = @$req->province;
                $CustomerDATA->specialinstruction = @$req->specialinstruction;
                $CustomerDATA->street = @$req->street;
                $CustomerDATA->telephoneno = @$req->telephoneno;
                $CustomerDATA->save();
                
                if(@$req->file("attachment")){
                $path = Storage::putFile('BookingSystemAttachments',$req->file("attachment"));
                $name = $req->file("attachment")->getClientOriginalName();
                }else{
                $path = '';
                $name = '';
                }
                  
                //REQUEST
                $RequestDATA = new BkRequest();
                $RequestDATA->requestid = @$req->requestid;
                $RequestDATA->requesttype = @$req->requestType;
                $RequestDATA->customerid = @$CustomerDATA->id;
                $CustomerDATA->landmark = @$req->landmark;
                $RequestDATA->bookby = @$req->bookby;
                $RequestDATA->status = @$req->identify == 1? 0 : 5;
                $RequestDATA->identify = @$req->requestType.'/'.@\Auth::user()->branch_id.'/'.@\Auth::user()->id;
                $RequestDATA->branch = @\Auth::user()->branch_id;
                $RequestDATA->userid = @\Auth::user()->id;
                $RequestDATA->unitid = @md5($req->requestid); 
                $RequestDATA->attachment = @$path;

                //LOCATION UNIT  
                $RequestDATA->locandorg = @$req->locanorg;
                // AND NAME OF ORGANIZATION
                $RequestDATA->organizationname = @$req->orgname;
                //SURVEY LOCATION
                $RequestDATA->surveyloc = @$req->surveylocation;

                $RequestDATA->additionalrequest1 = @$req->additionalrequest1;
                $RequestDATA->additionalrequest2 = @$req->additionalrequest2;
                $RequestDATA->specialinstruction = @$req->specialinstruction;
                $RequestDATA->save();
                foreach(json_decode($req->units) as $data) {
                   
                     
                  
                    $units = new BkUnits;
                    $units->unitid = md5($req->requestid);
                    $units->appliancetype = @$data->appliancetype;
                    $units->area = @$data->area;
                    $units->brand = @$data->brand;
                    $units->datepurchase = @$data->datepurchase;
                    $units->deliverydate = @$data->deliverydate;
                    $units->demandreplacement = @$data->demandreplacement;
                    $units->level = @$data->level;
                    $units->location = @$data->location;

                    //INSTALLATION ADDRESS
                    $units->locationofinstallation = $data->locationofinstallation === 0 ?@$req->barangay.','.@$req->mcity.','.@$req->province:  $data->locationofinstallation;
                    $units->model = @$data->model;
                    $units->paidamoun = @$data->paidamoun;
                    $units->priority = @$data->priority;
                    $units->prodcategories = @$data->prodcategories;
                    $units->ornumber = @$data->ornumber;
                    $units->qty = @$data->qty;
                    $units->problem = @$data->problem;
                    $units->serialno = @$data->serialno;
                    $units->time  = @$data->time->HH.':'.@$data->time->mm;
                    $units->unitcondition = @$data->unitcondition;
                    $units->wallfinish = @$data->wallfinish;
                    $units->warrantycondition = @$data->warrantycondition;
                    $units->withpowersupply = @$data->withpowersupply;
                     $units->save();
                    
                }
              
                $this->history($req);
                return response()->json(['ref'=>$req->requestid, 'iden'=>  @$req->identify == 1? 0:5, 'msg' => 'Success']);
            } 
                return response()->json(['ref'=> '', 'iden'=> 1,'msg' => 'File Exist']);
                
                    }catch(\Exception $e){
                        return response()->json($e);
                    }
                
    }
    public function jobs(request $req){
    
    if(\Auth::user()->hasRole(['AREA1'])){
        $region = 1;
    }
    if(\Auth::user()->hasRole(['AREA2'])){
        $region = 2;
    }
    if(\Auth::user()->hasRole(['AREA3'])){
        $region = 3;
    }
    if(\Auth::user()->hasRole(['AREASALL'])){
        $region = 4;
    }
    
    $branches = DB::table("branches")
                     ->where('region_id', $region)->pluck('id'); 
    if(@$req->id){
        $status = @$req->id;
    }else{
      
        $status = 0;
    }
    
      if(\Auth::user()->Branch->id == 5){
     return $data = BkRequest::with("customer")
                ->with("user")
                ->with("branch")
                ->with("units")
                ->with("BkJobsUpdate")
                ->where(function ($query) use($branches, $region) {
                    if($region !== 4){
                        for ($i = 0; $i < count($branches); $i++){
                            $query->orwhere('branch',   $branches[$i]  );
                        }
                    }
                    

                }
                )
                ->where("status",  $status)
            ->get();
      }else{
         $data = BkRequest::with("customer")
        ->with("user")
        ->with("branch")
        ->with("units")
        ->with("BkJobsUpdate")
        ->where("status", $status)
        ->where("branch", \Auth::user()->Branch->id)
        ->get();
      }
     return $data;
      
    }
    public function count(){
        if(\Auth::user()->Branch->id== 5){
            $UNSIGM = DB::table("bk_requests")->where("status", 0)->get();
            $ACCEPTED = DB::table("bk_requests")->where("status", 1)->get();
            $ASC = DB::table("bk_requests")->where("status", 2)->get();
            $ARRAYDATA = ["unsigned"=>count($UNSIGM),
                            "accepted"=> count($ACCEPTED),
                            "asc"=>count($ASC)];

        }else{
            $UNSIGM = DB::table("bk_requests")->where("status", 0)->where("branch", \Auth::user()->Branch->id)->get();
            $ACCEPTED = DB::table("bk_requests")->where("status", 1)->where("branch", \Auth::user()->Branch->id)->get();
            $ASC = DB::table("bk_requests")->where("status", 2)->where("branch", \Auth::user()->Branch->id)->get();
            $ARRAYDATA = ["unsigned"=>count($UNSIGM),
                            "accepted"=> count($ACCEPTED),
                            "asc"=>count($ASC)];
        }
       return $ARRAYDATA;
    }

    public function action(request $req){

      try{
        if($req->data['status'] == 'Unassigned'){
            $status = 0;
        }
        if($req->data['status'] == 'Accepted'){
            $status = 1;
        }
        if($req->data['status'] == 'Dispatch to Other ASC'){
            $status = 2;
        }
        $update = BkRequest::where("requestid", $req->data['requestID'])->first();
        $update->status = $status;
        $update->callid = $req->data['callid'];
        $update->installer = $req->data['installer'];
        $update->installationdate = $req->data['installationData'];
        $update->update();
        $msg = ["msg"=> 'Job '.$req->data['requestID'].' Success Update to '.$req->data['status'], "error"=> 'success', "type"=>1];
       }catch(\Exception $e){
        $msg = ["msg"=>  $e, "error"=> 'error'];
       }
       return $msg;
     
    }
    public function checkrecords(request $req){
       $check = BkCustomerHistory::where("cpnumber", 'like', '%'.$req->number.'%')->get();
       return response()->json($check);
    }
    public function downloadsales(request $req){
        $path = BkRequest::where('id', $req->id)
                ->pluck("attachment")
                ->first();
        $file = '../storage/app/'.$path;
        return response()->download($file);
     
    }
    public function restore(request $req){
        function ex($e){
            if($e){
                $d = explode("-", $e);
            return $data = BkRequest::with("customer")
                ->with("user")
                ->with("branch")
                ->with("units")
                ->with("BkJobsUpdate")
                ->where("status", 5)
                ->where("identify", $d[1].'/'.@\Auth::user()->branch_id.'/'.@\Auth::user()->id)
                ->get();
            }
        }
     return ex($req->type);
         
    }

    public function calendarschedule(){
        
        function calendar($sch){
              
            foreach($sch as $ds){
                $detail = ["requestid"=> $ds->requestid,
                           "callid"=> $ds->callid,
                           "customer"=> $ds->customer];
                $schedules[] = ["name"=> $ds->requesttype.' - '. $ds->customer->lastname .', '. $ds->customer->firstname,
                 "start"=> $ds->installationdate, 
                 "color"=> "green", 
                 "timed"=> true, 
                 "details"=> $detail];
            }
           return $schedules;
           
        }
        $data = BkRequest::with("customer")
                            ->with("user")
                            ->with("branch")
                            ->with("units")
                            ->with("BkJobsUpdate")
                            ->where("status", 1)
                            ->whereNotNull("installationdate")
                            ->get();
     
        return  calendar($data);
    }
}
