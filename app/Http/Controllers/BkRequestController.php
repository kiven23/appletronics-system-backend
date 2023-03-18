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
use GuzzleHttp\Client;
use App\user;
use DateTime;
use Carbon\Carbon;
class BkRequestController extends Controller
{
    public function history($req){
        if($req->cpnumber){
            $check = BkCustomerHistory::where("cpnumber", $req->cpnumber)->pluck('id')->first();
            if(!$check){
                $CustomerDATA = new BkCustomerHistory();
                $CustomerDATA->firstname =  ucfirst(@$req->firstname);
                $CustomerDATA->lastname  = ucfirst(@$req->lastname);
                $CustomerDATA->middlename  = ucfirst(@$req->middlename);
                $CustomerDATA->barangay  = @$req->barangay;
                $CustomerDATA->contactperson = @$req->contactperson;
                $CustomerDATA->cpnumber = '+63'.@$req->cpnumber;
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
                $CustomerDATA->firstname = ucfirst(@$req->firstname);
                $CustomerDATA->lastname  = ucfirst(@$req->lastname);
                $CustomerDATA->middlename  = ucfirst(@$req->middlename);
                $CustomerDATA->barangay  = @$req->barangay;
                $CustomerDATA->contactperson = @$req->contactperson? @$req->contactperson : 'N/A';
                $CustomerDATA->cpnumber = '+63'.@$req->cpnumber;
                $CustomerDATA->emailaddress = @$req->emailaddress?@$req->emailaddress : 'N/A';
                $CustomerDATA->houseno = @$req->houseno?@$req->houseno : 'N/A';
                $CustomerDATA->mcity = @$req->mcity? @$req->mcity : 'N/A';
                $CustomerDATA->organization = @$req->organization? @$req->organization : 'N/A';
                $CustomerDATA->province = @$req->province? @$req->province : 'N/A';
                $CustomerDATA->specialinstruction = @$req->specialinstruction? @$req->specialinstruction : 'N/A';
                $CustomerDATA->street = @$req->street?@$req->street : 'N/A';
                $CustomerDATA->telephoneno = @$req->telephoneno?@$req->telephoneno : 'N/A';
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
                $RequestDATA->landmark = @$req->landmark;
                $RequestDATA->bookby = @$req->bookby;
                $RequestDATA->status = @$req->identify == 1? 0 : 5;
                $RequestDATA->identify = @$req->requestType.'/'.@\Auth::user()->branch_id.'/'.@\Auth::user()->id;
                $RequestDATA->branch = @\Auth::user()->branch_id;
                $RequestDATA->userid = @\Auth::user()->id;
                $RequestDATA->unitid = @md5($req->requestid); 
                $RequestDATA->attachment = @$path;

                //LOCATION UNIT  
                $RequestDATA->locandorg = @$req->locanorg? @$req->locanorg :'N/A';
                // AND NAME OF ORGANIZATION
                $RequestDATA->organizationname = @$req->orgname? @$req->orgname : 'N/A' ;
                //SURVEY LOCATION
                $RequestDATA->surveyloc = @$req->surveylocation? @$req->surveylocation : 'N/A';

                $RequestDATA->additionalrequest1 = @$req->additionalrequest1;
                $RequestDATA->additionalrequest2 = @$req->additionalrequest2;
                $RequestDATA->specialinstruction = @$req->specialinstruction;
                $RequestDATA->save();
                

                $branchid = \Auth::user()->branch_id;
                $branch = DB::table("branches")->where("id", $branchid)->pluck("seriesname")->first();
                $ticketno = substr($branch,0,4).'-'.sprintf("%06s", $RequestDATA->id);
                DB::table("bk_requests")->where("id", $RequestDATA->id)->update([
                    "ticketno" => $ticketno
                ]);
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
                    $units->withpowersupply = @$data->withpowersupply->value;
                     $units->save();
                    
                }
                $this->history($req);
                return response()->json(['ref'=>$ticketno, 'iden'=>  @$req->identify == 1? 0:5, 'msg' => 'Success']);
            } 
                return response()->json(['ref'=> '', 'iden'=> 1,'msg' => 'File Exist']);
                    }catch(\Exception $e){
                        return response()->json($e);
                    }
                
    }
    public function jobs(request $req){

            if(@$req->id){
                   if($req->id == 3){
                    $status = 10;
                   }else{
                    $status = @$req->id;
                   }
                     
            }else{
                    $status = 0;
            }

            //$this->syncSapBookingSched();

            if(\Auth::user()->Branch->id == 5){
                if(\Auth::user()->hasRole(['AREA1'])){
                    $region = 8;
                }
                if(\Auth::user()->hasRole(['AREA2'])){
                    $region = 9;
                }
                if(\Auth::user()->hasRole(['AREA3'])){
                    $region = 10;
                }
                if(\Auth::user()->hasRole(['AREA4'])){
                    $region = 11;
                }
                if(\Auth::user()->hasRole(['AREASALL'])){
                    $region = 4;
                }
            
                $branches = DB::table("branches")
                                ->where('region_id', $region)->pluck('id'); 

                   $data = BkRequest::with(['customer'=> function($q){
                    $q->select(\DB::raw("*, CONCAT(lastname, ', ', firstname) as fullname"));
                  }])
                        ->with("user")
                        ->with("branch")
                        ->with("units")
                        ->with("BkJobsUpdate")
                        ->where(function ($query) use($branches, $region) {
                            if($region !== 4){
                                for ($i = 0; $i < count($branches); $i++){
                                    $query->orwhere('branch',   $branches[$i]);
                                }}
                        }
                        )
                        ->where("status",  $status)
                        ->orderby("updated_at","DESC")
                    ->get();
            }else{
                $data = BkRequest::with(['customer'=> function($q){
                    $q->select(\DB::raw("*, CONCAT(lastname, ', ', firstname) as fullname"));
                  }])
                ->with("user")
                ->with("branch")
                ->with("units")
                ->with("BkJobsUpdate")
                ->where("status", $status)
                ->where("branch", \Auth::user()->Branch->id)
                ->orderby("updated_at","DESC")
                ->get();
            }
            return $data;
   
    }
    public function count(){
        if(\Auth::user()->Branch->id== 5){
            //CALLIN1
            if(\Auth::user()->hasRole(['AREA1'])){
                $region = 8;
            }
            //CALLIN2
            if(\Auth::user()->hasRole(['AREA2'])){
                $region = 9;
            }
            //CALLIN3
            if(\Auth::user()->hasRole(['AREA3'])){
                $region = 10;
            }
            //CALLIN4
            if(\Auth::user()->hasRole(['AREA4'])){
                $region = 11;
            }
            if(\Auth::user()->hasRole(['AREASALL'])){
                $region = 4;
            }
            
            $branches = DB::table("branches")
                             ->where('region_id', $region)->pluck('id'); 
                             
            $UNSIGM = DB::table("bk_requests")->where("status", 0)
            ->where(function ($query) use($branches, $region) {
                if($region !== 4){
                    for ($i = 0; $i < count($branches); $i++){
                        $query->orwhere('branch',   $branches[$i]);
                    }}
            })
            ->get();
            $ACCEPTED = DB::table("bk_requests")->where("status", 1)
            ->where(function ($query) use($branches, $region) {
                if($region !== 4){
                    for ($i = 0; $i < count($branches); $i++){
                        $query->orwhere('branch',   $branches[$i]);
                    }}
            })->get();
            $ASC = DB::table("bk_requests")->where("status", 2)
            ->where(function ($query) use($branches, $region) {
                if($region !== 4){
                    for ($i = 0; $i < count($branches); $i++){
                        $query->orwhere('branch',   $branches[$i]);
                    }}
            })->get();
            $REJECTED = DB::table("bk_requests")->where("status", 10)
            ->where(function ($query) use($branches, $region) {
                if($region !== 4){
                    for ($i = 0; $i < count($branches); $i++){
                        $query->orwhere('branch',   $branches[$i]);
                    }}
            })->get();
            $ARRAYDATA = ["unsigned"=>count($UNSIGM),
                            "accepted"=> count($ACCEPTED),
                            "asc"=>count($ASC),
                            "rejected"=>count($REJECTED)];

        }else{
            $UNSIGM = DB::table("bk_requests")->where("status", 0)->where("branch", \Auth::user()->Branch->id)->get();
            $ACCEPTED = DB::table("bk_requests")->where("status", 1)->where("branch", \Auth::user()->Branch->id)->get();
            $ASC = DB::table("bk_requests")->where("status", 2)->where("branch", \Auth::user()->Branch->id)->get();
            $REJECTED = DB::table("bk_requests")->where("status", 10)->where("branch", \Auth::user()->Branch->id)->get();
            $ARRAYDATA = ["unsigned"=>count($UNSIGM),
                            "accepted"=> count($ACCEPTED),
                            "asc"=>count($ASC),
                            "rejected"=>count($REJECTED)];
        }
       return $ARRAYDATA;
    }

    public function action(request $req){
    
      try{
        // if($req->data['status'] == 'Unassigned'){
        //     $status = 0;
        // }
        // if($req->data['status'] == 'Accepted'){
        //     $status = 1;
        // }
        // if($req->data['status'] == 'Dispatch to Other ASC'){
        //     $status = 2;
        // }
        $update = BkRequest::where("requestid", $req->data['requestID'])->first();
        $update->status = 0;
        $update->callid = $req->data['callid'];
       // $update->installer = $req->data['installer'];
        //$update->installationdate = $req->data['installationData'];
         $update->update();
       $msg = ["msg"=> 'Job '.$req->data['requestID'].' Success Updated', "error"=> 'success', "type"=>1];
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

    //    return $dataD = BkRequest::with("customer")
    //     ->with("user")
    //     ->with("units")
    //     ->with("BkJobsUpdate")
    //     ->with("branch")
    //     ->whereNotNull("branch")
    //     ->whereHas("branch", function($query)  {
    //         $query->where("id", 47);
    //     })
    //     ->get();

       // Get the name of the branch for the current user
       #47 alexander
        $branchName = \Auth::user()->branch->id;  
        function calendar($sch){
              
            foreach($sch as $ds){
                  if($ds->installationdate){
                    $detail = ["requestid"=> $ds->requestid,
                    "callid"=> $ds->callid,
                    "customer"=> $ds->customer];
                    $schedules[] = [
                    "name"=> $ds->requesttype.' - '. $ds->customer->lastname .', '. $ds->customer->firstname,
                    "start"=> $ds->installationdate, 
                    "color"=> "green", 
                    
                    "timed"=> true, 
                    "details"=> $detail,
                    "UID"=>$ds->callID];
                 }
 
            }
           return $schedules;
           
        }
 
         $branchName = \Auth::user()->branch->id;
        if(\Auth::user()->Branch->id == 5){  
           $data = BkRequest::with("customer")
                ->with("user")
                ->with("units")
                ->with("branch")
                ->with("BkJobsUpdate")
                ->where("status", 1)
                ->orWhere("status", 2)
                ->whereNotNull("installationdate")
                ->get();
        }else{
        //     $dataD = BkRequest::with("customer")
        //     ->with("user")
        //     ->with("units")
        //     ->with("BkJobsUpdate")
        //     ->with(["branch"=> function($d){
        //         $d->where('id', 47);
                
        //     }])
        //     ->whereNotNull("branch")
        //     // ->where(function($query) use ($branchName) {
        //     //     $query->where("status", 1)
        //     //         ->orWhere("status", 2)
        //     //         ->whereNotNull("installationdate")
        //     //         ->whereHas("branch", function($q) use ($branchName) {
        //     //             $q->where("SAP_BRANCH", $branchName);
        //     //         });
        //     // }) 
        // ->get();


        $data = BkRequest::with("customer")
        ->with("user")
        ->with("units")
        ->with("BkJobsUpdate")
        ->with("branch")
   
        ->whereNotNull("branch")
        ->whereHas("branch", function($query)use($branchName)  {
            $query->where("id", $branchName);
        })
 
        ->get();



        
        }
      
       return $sched1 = calendar($data);


        function calendar1($sch){
              
            foreach($sch as $ds){
               
                $detail = ["requestid"=> $ds->subject ,
                           "callid"=> $ds->callID ,
                           "customer"=> [
                            "firstname"=> $ds->CustomerName,
                            "lastname"=> "",
                            "middlename"=> "",
                            "barangay"=> "",
                            "contactperson"=> "",
                            "cpnumber"=> $ds->contactnumber,
                            "emailaddress"=> "",
                            "houseno"=> "",
                            "mcity"=> $ds->city,
                            "organization"=> "",
                            "province"=> $ds->state,
                            "specialinstruction"=> "",
                            "street"=> "",
                            "telephoneno"=> "",
                             ]
                          ];
                $schedule=date_create($ds->U_SchedDate);
                $schedules[] = ["name"=> $ds->CustomerName,
                "start"=> date_format($schedule, "Y-m-d"), 
                 "color"=> "green", 
                 "timed"=> false, 
                 "details"=> $detail,
                 "UID"=>$ds->callID];
            }
           return $schedules;
           
        }
         #LATES FUNCTION TO FILTER BRANCHES SCHEDULE
        return $sched1;

        if(\Auth::user()->Branch->id == 5){
            // Define the SQL query using Laravel's Query Builder
            $db = DB::connection("sqlsrv3")->table("OSCL")
                ->selectRaw("OINS.custmrName as CustomerName, 
                            OINS.street as contactnumber,
                            OINS.zip as zip,
                            OINS.city as city,
                            OINS.country as country,
                            OINS.state as state,
                            OSCL.U_SchedDate as U_SchedDate,
                            OSCL.callID as callID,
                            OSCL.subject as subject,
                            OCRG.GroupName as branch")
                ->join("OINS", 'OSCL.internalSN', '=', 'OINS.internalSN')
                ->join("OCRD", "OSCL.customer", "=", "OCRD.cardcode")
                ->join("OCRG", "OCRD.GroupCode", "=", "OCRG.GroupCode")
                ->whereNotNull('OSCL.U_SchedDate')
                //->where("OCRG.GroupName", "LIKE", '%'.$branchName.'%')
                ->latest("OSCL.U_SchedDate")
                ->take(500)
                ->get();
        }else{
            // Define the SQL query using Laravel's Query Builder
            $db = DB::connection("sqlsrv3")->table("OSCL")
                ->selectRaw("OINS.custmrName as CustomerName, 
                            OINS.street as contactnumber,
                            OINS.zip as zip,
                            OINS.city as city,
                            OINS.country as country,
                            OINS.state as state,
                            OSCL.U_SchedDate as U_SchedDate,
                            OSCL.callID as callID,
                            OSCL.subject as subject,
                            OCRG.GroupName as branch")
                ->join("OINS", 'OSCL.internalSN', '=', 'OINS.internalSN')
                ->join("OCRD", "OSCL.customer", "=", "OCRD.cardcode")
                ->join("OCRG", "OCRD.GroupCode", "=", "OCRG.GroupCode")
                ->whereNotNull('OSCL.U_SchedDate')
                 ->where("OCRG.GroupName", "LIKE", '%'.$branchName.'%')
                ->latest("OSCL.U_SchedDate")
                ->take(500)
                ->get();
        }

    
    
    $sched2 = calendar1($db);
    return  array_merge($sched1, $sched2);
 
    }
    public function syncSapBookingSched(){

 
        function calendar($sch){
              
            foreach($sch as $ds){
               
                $detail = ["requestid"=> $ds->subject ,
                           "callid"=> $ds->callID ,
                           "customer"=> [
                            "firstname"=> $ds->CustomerName,
                            "lastname"=> "",
                            "middlename"=> "",
                            "barangay"=> "",
                            "contactperson"=> "",
                            "cpnumber"=> $ds->contactnumber,
                            "emailaddress"=> "",
                            "houseno"=> "",
                            "mcity"=> $ds->city,
                            "organization"=> "",
                            "province"=> $ds->state,
                            "specialinstruction"=> "",
                            "street"=> "",
                            "telephoneno"=> "",
                             ]
                          ];
                $schedule=date_create($ds->U_SchedDate);
                $schedules[] = ["name"=> $ds->CustomerName,
                 "start"=> date_format( $schedule, "Y-m-d"), 
                 "color"=> "green", 
                 "timed"=> true, 
                 "details"=> $detail];
            }
           return $schedules;
           
        }
        function sapDataConnect($callid){
            $dd = DB::connection("sqlsrv3")->table("OSCL")
                ->join("OINS", 'OSCL.internalSN', '=', 'OINS.internalSN')
                ->leftjoin("OHEM", 'OSCL.technician', '=', 'OHEM.empID')
                ->join("OCLG", 'OSCL.callID', '=', 'OCLG.parentId' )
                ->join("UFD1", 'OSCL.U_CallStatusReason', '=', 'UFD1.FldValue')
                ->select(\DB::raw("OINS.custmrName as CustomerName"), 
                                "OINS.street as contactnumber",
                                "OINS.zip as zip",
                                "OINS.city as city",
                                "OINS.country as country",
                                "OINS.state as state",
                                "OSCL.U_SchedDate as U_SchedDate",
                                "OSCL.U_comTime as comTime",
                                "OSCL.callID as callID",
                                "OHEM.lastName as techL",
                                "OHEM.firstName as techF",
                                "OSCL.U_CallStatusReason as Stat",
                                "UFD1.Descr as reason",
                                "OCLG.Notes"           
                )
                //->latest("OSCL.U_SchedDate")
                ->where("OSCL.callID", $callid)
                ->first();
            if($dd){
                return $dd; 
            } 
        }
       
        # NEW CODE =========================================
       $callID  =  DB::table("bk_requests")->whereNotNull("callid")->select("callid")->get()->toArray();
        $sapData = array_filter(array_map(function($sData) {
            return sapDataConnect($sData->callid);
        }, $callID));
       $db = array_filter($sapData);
        #END CODE =========================================
        
       
        function Times($schedule,$time,$index){
            if($time && $schedule){
                $add = \Carbon\Carbon::parse(sprintf("%04d", $time))->format('H:i:s');
                $sd =  new carbon($add);
                $customize =  $sd->addMinutes($index)->toTimeString();
                 return  $schedule.' '.$customize ;
            }else{
                if($schedule){
                    return $schedule;
                }else{
                    return NULL;
                }
                
            }
        }
        function IdentifyNotify($callid){
            $val = 0;
                $identify = DB::table('bk_requests')->where('callid', $callid)->pluck("notify")->first();
                if($identify || $identify === 0){
                    $val = $identify;
                }
                else{
                    $val = 1;
                }
                return $val;
        }

        // $dd = [];
        // $reset_index = 12;
        // foreach ($db as $index => $up) {
        //     if ($up->U_SchedDate) {
        //         $createDate = date_create($up->U_SchedDate);
        //         $schedule = date_format($createDate, "Y-m-d");
        //     } else {
        //         $schedule = NULL;
        //     }
        //     $dd[] = Times($schedule, $up->comTime, $index % 12); // use modulo 12 to get the index within the range 0-11
        //     if (($index + 1) % $reset_index === 0) {
        //         $reset_index += 12; // set the next reset index
        //         $index = $reset_index - 1; // reset the index to the last value of the current sequence
        //     }
        // }
        // return $dd;
 
        $dd = [];
        $reset_index = 12;  
       foreach($db as $index=>$up){
       
        if($up->U_SchedDate){
            $createDate = date_create($up->U_SchedDate);
            $schedule = date_format($createDate, "Y-m-d");
        }else{
            
            $schedule = NULL;
        }
        
        $technician = strtoupper($up->techL.', '.$up->techF);
 
        #FORACCEPT
        if($schedule && $technician && $up->Stat !== 'Closed07'){
              DB::table("bk_requests")->where("callid", $up->callID)->update([
                      'installationdate' =>  Times($schedule, $up->comTime, $index % 12),
                      'installer'=> $technician,
                      'notes'=> $up->Notes,
                      'status'=> 1, 
                      'reason'=> $up->reason,
                      'notify'=>  IdentifyNotify($up->callID)
        ]) ; 
        #FOR UNASSIGNED
        }else{
            DB::table("bk_requests")->where("callid", $up->callID)->update([
                'installationdate' =>  Times($schedule, $up->comTime, $index % 12),
                'installer'=> $technician,
                'notes'=> $up->Notes,
                'status'=> 0,
                'reason'=> $up->reason,
                'notify'=>  IdentifyNotify($up->callID)
            ]) ;  
        }
        #FOR ASC DISPATCH
        if($up->Stat == 'Pending05'){
            DB::table("bk_requests")->where("callid", $up->callID)->update([
                'installationdate' =>  Times($schedule, $up->comTime, $index % 12) ,
                'installer'=> $technician,
                'notes'=> $up->Notes,
                'status'=> 2,
                'reason'=> $up->reason,
                'notify'=>  IdentifyNotify($up->callID)
            ]) ;  
        }
        #FOR REJECTION
        if($up->Stat == 'Closed07'){
            DB::table("bk_requests")->where("callid", $up->callID)->update([
                'installationdate' =>  Times($schedule, $up->comTime, $index % 12) ,
                'installer'=> $technician,
                'notes'=> $up->Notes,
                'status'=> 10,
                'reason'=> $up->reason,
                'notify'=>  IdentifyNotify($up->callID)
            ]) ;  
        }
            if (($index + 1) % $reset_index === 0) {
                 $reset_index += 12; // set the next reset index
                $index = $reset_index - 1; // reset the index to the last value of the current sequence
            }
    }
    return 'sync';
           
    return calendar($db);
    }
    public function trash(request $req){
        $trash = BkRequest::where("id", $req->id)->first();
        $idt =  $trash->unitid;
        $trash->delete();
      
        $trash2 = BkUnits::where("unitid", $idt)->first();
        $trash2->delete();
        return "ok";
    }
    public function exec(){

        $items = DB::table("bk_items")->get();
        $type = DB::table("bk_types")->get(); 
        $brand = DB::table("bk_brand")->get();
        $cat = DB::table("bk_categories")->get();

        $arrCust = ['nomodel'=> 1,
                    'model'=> 'NO MODEL',
                    'cat' => $cat,
                    'Brand2'=> $brand,
                    "categories"=> "",
                    'type'=> $type];
        $items[] =  $arrCust;


        return $items;
        $full_link = 'http://192.168.1.19:8081/api2/all.json';
        $unparsed_json = file_get_contents($full_link);
        $json_object = json_decode($unparsed_json);
    
        foreach($json_object  as $res){
            if(@$res->nomodel == 1){
                foreach($res->cat as $brand){
                    DB::table("bk_categories")->insert([
                        "name" => @$brand->name,
                        "value"=> @$brand->value,
                        "identity" => 2
                     ]);
                }
                
            }
              
        }
        return 'ok';
    }
    public function fields(request $req){
        if($req->list == 1){
            if($req->id == 4){
            return DB::table("bk_items")->get();
         
            }else{
                $type = DB::table("bk_types")->where('identity', $req->id) ->latest()->get(); 
                $brand = DB::table("bk_brand")->where('identity', $req->id) ->latest()->get();
                $cat = DB::table("bk_categories")->where('identity', $req->id) ->latest()->get();
                
                $type_array = $type->toArray();
                $brand_array = $brand->toArray();
                $cat_array = $cat->toArray();
                 
                $arr = array_merge($type_array,$brand_array,$cat_array);
                return $arr;
            }
        }
        if($req->list == 2){
            $type = DB::table("bk_types") ->latest()->get(); 
            $brand = DB::table("bk_brand") ->latest()->get();
            $cat = DB::table("bk_categories") ->latest()->get();
            $arr = [
                "type"=> $type,
                "brand"=>  $brand,
                "cat"=>  $cat,
            ];
            return $arr;
        }
     
    }
     
    public function createFields(request $req){
        #FOR TYPE
        if($req->type == 1){
           $table = "bk_types";
        }
        #FOR CAT
        if($req->type == 2){
            $table = "bk_brand";
        }
        #FOR BRAND
        if($req->type == 3){
            $table = "bk_categories";
        }
        if($req->identify == 0){
            DB::table($table)->insert([
                "name"=> $req->fields,
                "value"=> $req->fields,
                "identity"=> $req->type,
                "created_at"=> date("Y-m-d h:i:s")
            ]);
        }
        if($req->identify == 1){
            DB::table($table)->where("id",$req->id)->update([
                "name"=> $req->fields,
                "value"=> $req->fields,
                "identity"=> $req->type,
                "created_at"=> date("Y-m-d h:i:s")
            ]);
        }

         


        return "OK";
    }
     
    public function deleteitems(request $req){
        DB::table('bk_items')->where("id", $req->id)->delete();
        return "ok";
    }
    public function deleteFields(request $req){
         #FOR TYPE
         if($req->type == 1){
            $table = "bk_types";
         }
         #FOR CAT
         if($req->type == 2){
             $table = "bk_brand";
         }
         #FOR BRAND
         if($req->type == 3){
             $table = "bk_categories";
         }
         DB::table($table)->where("id", $req->id)->delete();
        return "ok";
    }
    public function createitem(request $req){
        
        if($req->model){
            if($req->identify == 0){
                DB::table("bk_items")->insert([
                    "Brand" => $req->brand,
                    "categories" => $req->cat,
                    "type" => $req->type,
                    "model" => $req->model
                ]);
            }
            if($req->identify == 1){
                DB::table("bk_items")->where('id', $req->id)->update([
                    "Brand" => $req->brand,
                    "categories" => $req->cat,
                    "type" => $req->type,
                    "model" => $req->model
                ]);
            }
            
            $msg = 'ok';
        }else{
            $msg = 'required fields';
        }
        return "ok";
    }
    public function execute(){
        $full_link = 'http://192.168.1.19:8012/api2/all.json';
        $unparsed_json = file_get_contents($full_link);
        $json_object = json_decode($unparsed_json);
    
        foreach($json_object  as $res){
          DB::Table("bk_items")->insert([
           
            "Brand"=>@$res->Brand,
            "categories"=>@$res->categories,
            "type"=>@$res->type,
            "model"=>@$res->model,
            "SQM"=>@$res->SQM
          ]);
              
        }
        return 'ok';
        return  $db =  DB::connection("sqlsrv3")->table("OSCL")->where('U_CallStatusReason', "Pending05")->get();
    }
    public function testDb(){
    // return  DB::connection("sqlsrv3")->table("UFD1")->where("TableID", "ASCL")->get();
    //return "Hold";
    return $this->syncSapBookingSched();
    return   DB::connection("sqlsrv3")->table("OSCL")
       ->join("OINS", 'OSCL.internalSN', '=', 'OINS.internalSN')
       ->join("OHEM", 'OSCL.technician', '=', 'OHEM.empID')
       ->join("OCLG", 'OSCL.callID', '=', 'OCLG.parentId' )
       ->join("UFD1", 'OSCL.U_CallStatusReason', '=', 'UFD1.FldValue')
       ->select(\DB::raw(
                       "OINS.custmrName as CustomerName"),   
                       "OINS.street as contactnumber",
                       "OINS.zip as zip",
                       "OINS.city as city",
                       "OINS.country as country",
                       "OINS.state as state",
                       "OSCL.U_SchedDate as U_SchedDate",
                       "OSCL.callID as callID",
                       "OHEM.lastName as techL",
                       "OHEM.firstName as techF",
                       "OSCL.U_CallStatusReason as Stat" ,
                       "UFD1.Descr as reason",
                        "OCLG.Notes"            
       )
      // ->whereNull('OSCL.U_SchedDate')
      // ->latest("OSCL.U_SchedDate")
        //->take(10)
        ->where("OSCL.callID", '120124')
       // ->whereYear("OSCL.U_SchedDate", '2022')
       // ->whereMonth("OSCL.U_SchedDate", '>=','08')
       ->get();
    }
    public function notify(){
        return BkRequest::select("callid","requestid","installer","installationdate","reason as status")
        ->where("branch", 47)
        ->where('status', 1)
        ->whereNotNull('notify')->get();
        return "test";
    }
}
