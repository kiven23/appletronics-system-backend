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
use App\BkAttachment;
use App\SelfBooking;
use hash;
use GuzzleHttp\Client;
use App\user;
use DateTime;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Config;
class BkRequestController extends Controller
{
    public function dbcontroller($cname,$database){
        
        $connection = $cname;
        $config = [
            'driver' => 'sqlsrv',
            'host' => env('DATABASEHOST'),
            'port' => env('DATAPOSTPORT'),
            'database' => $database,
            'username' => env('DATABASEUSERNAME'),
            'password' => env('DATABASEPASSWORD'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ];
        Config::set("database.connections.$connection", $config);
        return $connection;
    }

    public function regionMap($id){
    
        $client = new Client();
        $response = $client->get('http://192.168.1.19:8012/api2/region.json');
        foreach(json_decode($response->getBody()) as $data){
          $d = (int) $data->region_code;
          if($d == $id){
            $arr = ['name'=> $data->region_name, 'id'=> $data->region_code] ;
          }
        }
        return $arr;
    }
    
    public function history($i,$req){
        if($req->cpnumber){
            $check = BkCustomerHistory::where("cpnumber", $req->cpnumber)->pluck('id')->first();
            if(!$check){
                if($i == 1){
                    $CustomerDATA = BkCustomerHistory::where('cpnumber', $req->cpnumber)->first();
                }else{
                    $CustomerDATA = new BkCustomerHistory();
                }
                $CustomerDATA = new BkCustomerHistory();
                $CustomerDATA->firstname =  ucfirst(@$req->firstname);
                $CustomerDATA->lastname  = ucfirst(@$req->lastname);
                $CustomerDATA->middlename  = ucfirst(@$req->middlename);
                $CustomerDATA->barangay  = @$req->barangay;
                $CustomerDATA->contactperson = @$req->contactperson;
                $CustomerDATA->cpnumber = @$req->cpnumber;
                $CustomerDATA->emailaddress = @$req->emailaddress;
                $CustomerDATA->region_id  =  $this->regionMap($req->region)['id'];
                $CustomerDATA->region_name  = $this->regionMap($req->region)['name'];
                $CustomerDATA->houseno = @$req->houseno;
                $CustomerDATA->mcity = @$req->mcity;
                $CustomerDATA->organization = @$req->organization;
                $CustomerDATA->province = @$req->province;
                $CustomerDATA->specialinstruction = @$req->specialinstruction;
                $CustomerDATA->street = @$req->street;
                $CustomerDATA->telephoneno = @$req->telephoneno;
                if($i == 1){
                $CustomerDATA->update();
                }else{
                $CustomerDATA->save();
                }
            } 
            if($check){
                $CustomerDATA = BkCustomerHistory::find($check);
                $CustomerDATA->firstname =  ucfirst(@$req->firstname);
                $CustomerDATA->lastname  = ucfirst(@$req->lastname);
                $CustomerDATA->middlename  = ucfirst(@$req->middlename);
                $CustomerDATA->barangay  = @$req->barangay;
                $CustomerDATA->contactperson = @$req->contactperson;
                $CustomerDATA->cpnumber = @$req->cpnumber;
                $CustomerDATA->emailaddress = @$req->emailaddress;
                $CustomerDATA->region_id  =  $this->regionMap($req->region)['id'];
                $CustomerDATA->region_name  = $this->regionMap($req->region)['name'];
                $CustomerDATA->houseno = @$req->houseno;
                $CustomerDATA->mcity = @$req->mcity;
                $CustomerDATA->organization = @$req->organization;
                $CustomerDATA->province = @$req->province;
                $CustomerDATA->specialinstruction = @$req->specialinstruction;
                $CustomerDATA->street = @$req->street;
                $CustomerDATA->telephoneno = @$req->telephoneno;
                $CustomerDATA->update();
            }
        }
       return "OK";
    }
    public function store(request $req){
        

        function attachment($attachment_id, $attachment_type, $req){
            $name = $req->file("file")->getClientOriginalName();
            if($name){
                $checknameexist = DB::table('bk_attachments')->where('name', $attachment_id.'-'.$name)->pluck('name')->first();
                if(!$checknameexist){
                        $path = Storage::disk('appletronics')->putFile('/', $req->file('file'));
                    
                        DB::table('bk_attachments')->insert([
                            'attachment_id' => $attachment_id,
                            'attachment_type' => $attachment_type,
                            'attachment_loc' => $path,
                            'name' => $attachment_id.'-'.$name
                    ]);
                    $getData =  DB::table('bk_attachments')->where('attachment_id', $attachment_id)->get();
                    return response()->json(["msg"=>'The File has been Uploaded Successful '.$name, "color"=> 'success', 'data'=>  $getData]);
                }else{
                    return response()->json(["msg"=>'The File Already Exist '.$name, "color"=> 'warning']);
                }
            }
            
            }
                    
         $checkData = BkRequest::where('requestid', $req->requestid)->pluck('requestid')->first();
        //CUSTOMER
        try{
             
            if(!$checkData){
                  
                $CustomerDATA = new BkCustomerInfo();
                $CustomerDATA->firstname = ucfirst(@$req->firstname);
                $CustomerDATA->lastname  = ucfirst(@$req->lastname);
                $CustomerDATA->middlename  = ucfirst(@$req->middlename);
                $CustomerDATA->barangay  = @$req->barangay;
                 
                $CustomerDATA->region_id  =  $this->regionMap($req->region)['id'];
                 
                $CustomerDATA->region_name  = $this->regionMap($req->region)['name'];
               
                $CustomerDATA->contactperson = @$req->contactperson? @$req->contactperson : 'N/A';
                $CustomerDATA->cpnumber = @$req->cpnumber;
                
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
                // $path = Storage::putFile('BookingSystemAttachments',$req->file("attachment"));
                // $name = $req->file("attachment")->getClientOriginalName();
                $path = Storage::disk('appletronics')->putFile('/', $req->file('attachment'));
                $name = $req->file("attachment")->getClientOriginalName();
                }else{
                $path = $req->attachment;
                $name = $req->attachmentN;
                }
                 
                //REQUEST
                $RequestDATA = new BkRequest();
                $RequestDATA->filename = $name;
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
                $RequestDATA->ifseries = 1;
                $RequestDATA->save();
                
                
                

                $branchid = \Auth::user()->branch_id;
                $branch = DB::table("branches")->where("id", $branchid)->pluck("sapcode")->first();
                //GET STARTING SERIES AT BRANCH
                $getstarting = DB::table("branches")->where("id", $branchid)->pluck("seriesno")->first();
                $ticketno = substr($branch,0,4).'-'.sprintf("%06s",$getstarting+1);
        
                //UPDATE SERIES AT BRANCH TO USED NEXT SERIES IF INPUT ANOTHER ONE
                DB::table("branches")->where("id", $branchid)->update([
                    "seriesno" => sprintf("%06s",$getstarting+1)
                ]);
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
                    $units->propertytype = @$data->propertytype;
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
                    if($req->file("file")){
                        attachment($RequestDATA->id, 0, @$req);
                        }
                }
                $this->history(0,$req);
                if($req->restoreid){
                    $this->close($req->restoreid);
                }
                $bname = DB::table("branches")->where("id", $branchid)->pluck("name")->first();
                return response()->json(['branch'=> $bname,'ref'=>$ticketno, 'iden'=>  @$req->identify == 1? 0:5, 'msg' => 'Success']);
            } 
                return response()->json(['ref'=> '', 'iden'=> 1,'msg' => 'File Exist']);
                    }catch(\Exception $e){
                        return response()->json($e);
                    }
                
    }
    public function attachment(request $req){
            return $req;
    }
    public function jobs(request $req){
            if($req->key){
               $number = DB::table('self_bookings')
               ->where('id', $req->key)
               ->pluck('phone')->first();
            }else{
                $number = '';
            }
             
            $i = 0;
            if(@$req->id){
                   if($req->id == 3){
                    $status = 10;
                   }elseif($req->id == 5){
                    $i = 5;
                    $status = 1;
                   }elseif($req->id == 4){
                    
                    $status = 4;
                   }else{
                    $status = @$req->id;
                    $i = 6;
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
                if(\Auth::user()->hasRole(['AREA5'])){
                    $region = 13;
                }
                if(\Auth::user()->hasRole(['AREA6'])){
                    $region = 14;
                }
                if(\Auth::user()->hasRole(['AREASALL'])){
                    $region = 4;
                }
                $completed = ['Repaired and Released','Return to Owner (RTO)','Checked up','Installed', 'Repaired', 'Cleaned', 'Surveyed', 'Dismantled', 'Replaced', 'Endorsed to Other ASC'];
                $branches = DB::table("branches")
                                ->where('region_id', $region)->pluck('id'); 

                   $data = BkRequest::with(['customer'=> function($q){
                    $q->select(\DB::raw("*, CONCAT(lastname, ', ', firstname) as fullname"));
                  }])
                        ->with('attachfiles')
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
                        ->when($i == 5, function ($query)use($completed)  {
                            return $query->whereIn('reason' , $completed);   
                        })
                        ->when($i == 6, function ($query)use($completed)  {
                            return $query->whereNotIn('reason' , $completed);   
                        })
                         
                        ->orderby("created_at","DESC")
                    ->get();
            }else{
                $completed = ['Repaired and Released','Return to Owner (RTO)','Checked up','Installed', 'Repaired', 'Cleaned', 'Surveyed', 'Dismantled', 'Replaced', 'Endorsed to Other ASC'];
                $data = BkRequest::with(['customer'=> function($q)use($number){
                    $q->select(\DB::raw("*, CONCAT(lastname, ', ', firstname) as fullname")) ;
                  }]) 
                  ->when(!empty($number), function ($query) use ($number) {
                    return $query->whereHas('customer', function ($q) use ($number) {
                        $q->where('cpnumber', $number);
                    });
                })
                ->with('attachfiles')
                ->with("user")
                ->with("branch")
                ->with("units")
                ->with("BkJobsUpdate")
                ->where("status", $status)
                ->when($i == 5, function ($query)use($completed)  {
                    return $query->whereIn('reason' , $completed);   
                })
                ->when($i == 6, function ($query)use($completed)  {
                    return $query->whereNotIn('reason' , $completed);   
                })
              
                ->where("branch", \Auth::user()->Branch->id)
                ->orderby("created_at","DESC")
                ->get();
            }
            return $data;
   
    }
    public function count(Request $req){
        if($req->key){
            $number = DB::table('self_bookings')
            ->where('id', $req->key)
            ->pluck('phone')->first();
            $customerID = DB::table('bk_customer_infos')->where('cpnumber', 'like','%'.$number.'%' )->select('id')->get();
            foreach($customerID as $c){
                $data [] = $c->id;
            }
            
         }else{
            $data = [];
         }
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
            if(\Auth::user()->hasRole(['AREA5'])){
                $region = 13;
            }
            if(\Auth::user()->hasRole(['AREA6'])){
                $region = 14;
            }
            if(\Auth::user()->hasRole(['AREASALL'])){
                $region = 4;
            }
            $completed = ['Repaired and Released','Return to Owner (RTO)','Checked up','Installed', 'Repaired', 'Cleaned', 'Surveyed', 'Dismantled', 'Replaced', 'Endorsed to Other ASC'];
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

            //pending
            $ACCEPTED = DB::table("bk_requests")->where("status", 1)
            ->where(function ($query) use($branches, $region) {
                if($region !== 4){
                    for ($i = 0; $i < count($branches); $i++){
                        $query->orwhere('branch',   $branches[$i]);
                    }}
            })->whereNotIn('reason' , $completed)->get();
            //completed
            $COMPLETED = DB::table("bk_requests")->where("status", 1)
            ->where(function ($query) use($branches, $region) {
                if($region !== 4){
                    for ($i = 0; $i < count($branches); $i++){
                        $query->orwhere('branch',   $branches[$i]);
                    }}
            })->whereIn('reason' , $completed)->get();

            
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
            $HOLD = DB::table("bk_requests")->where("status", 4)
            ->where(function ($query) use($branches, $region) {
                if($region !== 4){
                    for ($i = 0; $i < count($branches); $i++){
                        $query->orwhere('branch',   $branches[$i]);
                    }}
            })->get();
            $ARRAYDATA = ["unsigned"=>count($UNSIGM),
                            "accepted"=> count($ACCEPTED),
                            "asc"=>count($ASC),
                            "completed"=>count($COMPLETED),
                            "hold"=>count($HOLD),
                            "rejected"=>count($REJECTED)];

        }else{
            
            $completed = ['Repaired and Released','Return to Owner (RTO)','Checked up','Installed', 'Repaired', 'Cleaned', 'Surveyed', 'Dismantled', 'Replaced', 'Endorsed to Other ASC'];
            $UNSIGM = DB::table("bk_requests")
                ->where("status", 0)
                ->where("branch", \Auth::user()->Branch->id)
                ->when(!empty($data), function ($query) use ($data) {
                    $query->whereIn('customerid', $data);
                })
                ->get();
            $COMPLETED = DB::table("bk_requests")
                ->where("status", 1)
                ->where("branch", \Auth::user()->Branch->id)
                ->whereIn('reason' , $completed)
                ->when(!empty($data), function ($query) use ($data) {
                    $query->whereIn('customerid', $data);
                })
                ->get();
            $ACCEPTED = DB::table("bk_requests")
                ->where("status", 1)
                ->where("branch", \Auth::user()->Branch->id)
                ->whereNotIn('reason' , $completed)
                ->when(!empty($data), function ($query) use ($data) {
                    $query->whereIn('customerid', $data);
                })
                ->get();
            $ASC = DB::table("bk_requests")
                ->where("status", 2)
                ->where("branch", \Auth::user()->Branch->id)
                ->when(!empty($data), function ($query) use ($data) {
                    $query->whereIn('customerid', $data);
                })
                ->get();
            $REJECTED = DB::table("bk_requests")
                ->where("status", 10)
                ->where("branch", \Auth::user()->Branch->id)
                ->when(!empty($data), function ($query) use ($data) {
                    $query->whereIn('customerid', $data);
                })
                ->get();    
            $HOLD = DB::table("bk_requests")
                ->where("status", 4)
                ->where("branch", \Auth::user()->Branch->id)
                ->when(!empty($data), function ($query) use ($data) {
                    $query->whereIn('customerid', $data);
                })
                ->get();

            $ARRAYDATA = ["unsigned"=>count($UNSIGM),
                            "accepted"=> count($ACCEPTED),
                            "completed"=>count($COMPLETED),
                            "asc"=>count($ASC),
                            "hold"=>count($HOLD),
                            "rejected"=>count($REJECTED)];
        }
       return $ARRAYDATA;
    }

    public function action(request $req){
         
      try{
   
        $update = BkRequest::where("id", @$req->data['realid'])->first();
        if($req->data['status'] == 4 || $req->data['status'] == 10){
            
           $update->status = $req->data['identifier'] == 4 ||  $req->data['identifier'] == 10 ? $req->data['status'] == 4? 0: 10 : $req->data['status'];
            $update->notes = $req->data['reason'];
        }else{
            
            $check = BkRequest::where("callid", $req->data['callid'])->first();
            if(!$check){
                $update->callid = $req->data['callid'];
                $ch = 1;
            }else{
                $ch = 0;
            }
            $update->status = 0;
          
            if($req->data['callid']){
                $update->notify = 6;
            }
        }
         
         

        $update->update();
       $msg = ["msg"=> 'Job '.$req->data['requestID'].' Success Updated', "error"=> 'success', "type"=>1, "ch" => @$ch];
       }catch(\Exception $e){
        return $e;
        $msg = ["msg"=>  $e, "error"=> 'error'];
       }
       return $msg;
     
    }
    public function checkrecords(request $req){
       $check = BkCustomerHistory::where("cpnumber", 'like', '%'.$req->number.'%')->get();
       return response()->json($check);
    }
    public function downloadsales(request $req){
      
        try {
            $path = BkRequest::where('id', $req->id)
                ->pluck("attachment")
                ->first();
        
            try {
            $fallbackPath = '/media/webportal/backup1/appletronicsData/bookingsystem/attachment';
            $file = $fallbackPath .'/'. $path;
          
            return response()->download($file);
            }catch (\Exception $e) {
                $fallbackPath = '/media/webportal/backup/appletronicsData/bookingsystem/attachment';
                $file = $fallbackPath .'/'. $path;
          
            return response()->download($file);
         }
        } catch (\Exception $e) {
           
            \Log::error("Error downloading file from initial path: " . $e->getMessage());
        
           
            try {
                $fallbackPath = '/media/webportal/backup/appletronicsData/bookingsystem/attachment';
                $file = $fallbackPath . '/' . $path;
        
                
                return response()->download($file);
            } catch (\Exception $fallbackException) {
          
                \Log::error("Error downloading file from fallback path: " . $fallbackException->getMessage());
        
               
                return response()->json(['error' => 'Failed to download file.'], 500);
            }
        }
        
    }
    public function additional(request $req){
                 
         
                $path = BkAttachment::where('id', $req->id)
                ->pluck("attachment_loc")
                ->first();
                try{
                    $fallbackPath = '/media/webportal/backup1/appletronicsData/bookingsystem/attachment';
                    $file = $fallbackPath . '/' . $path;
           
                   
                   return response()->download($file);
                } catch (\Exception $e) {
                    $fallbackPath = '/media/webportal/backup/appletronicsData/bookingsystem/attachment';
                    $file = $fallbackPath . '/' . $path;
           
                   
                   return response()->download($file);
                }
              
       
      
        
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
    public function close($id){
        $data = BkRequest::with("customer")->where('id', $id)
        ->update(['status' => 222]);
        return $data;
    }

    public function calendarschedule(){
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
        if(\Auth::user()->hasRole(['AREA5'])){
            $region = 13;
        }
        if(\Auth::user()->hasRole(['AREA6'])){
            $region = 14;
        }
        if(\Auth::user()->hasRole(['AREASALL'])){
            $region = 4;
        }
         
        $branches = DB::table("branches")
                         ->where('region_id', $region)->pluck('id'); 
                         
      
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
            if($region == 4){
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
                 
                $data = BkRequest::with("customer")
                    ->with("user")
                    ->with("units")
                    ->with("branch")
                    ->with("BkJobsUpdate")
                    ->where(function($query) {
                        $query->where("status", 1)
                              ->orWhere("status", 2);
                    })
                    ->whereNotNull("installationdate")
                    ->whereHas("branch", function($query) use ($branches) {
                        $query->whereIn('id', $branches);
                    })
                    ->get();
            
            }
          
        }else{
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


    //     function calendar1($sch){
              
    //         foreach($sch as $ds){
               
    //             $detail = ["requestid"=> $ds->subject ,
    //                        "callid"=> $ds->callID ,
    //                        "customer"=> [
    //                         "firstname"=> $ds->CustomerName,
    //                         "lastname"=> "",
    //                         "middlename"=> "",
    //                         "barangay"=> "",
    //                         "contactperson"=> "",
    //                         "cpnumber"=> $ds->contactnumber,
    //                         "emailaddress"=> "",
    //                         "houseno"=> "",
    //                         "mcity"=> $ds->city,
    //                         "organization"=> "",
    //                         "province"=> $ds->state,
    //                         "specialinstruction"=> "",
    //                         "street"=> "",
    //                         "telephoneno"=> "",
    //                          ]
    //                       ];
    //             $schedule=date_create($ds->U_SchedDate);
    //             $schedules[] = ["name"=> $ds->CustomerName,
    //             "start"=> date_format($schedule, "Y-m-d"), 
    //              "color"=> "green", 
    //              "timed"=> false, 
    //              "details"=> $detail,
    //              "UID"=>$ds->callID];
    //         }
    //        return $schedules;
           
    //     }
    //      #LATES FUNCTION TO FILTER BRANCHES SCHEDULE
    //     return $sched1;

    //     if(\Auth::user()->Branch->id == 5){
    //         // Define the SQL query using Laravel's Query Builder
    //         $db = DB::connection("sqlsrv3")->table("OSCL")
    //             ->selectRaw("OINS.custmrName as CustomerName, 
    //                         OINS.street as contactnumber,
    //                         OINS.zip as zip,
    //                         OINS.city as city,
    //                         OINS.country as country,
    //                         OINS.state as state,
    //                         OSCL.U_SchedDate as U_SchedDate,
    //                         OSCL.callID as callID,
    //                         OSCL.subject as subject,
    //                         OCRG.GroupName as branch")
    //             ->join("OINS", 'OSCL.internalSN', '=', 'OINS.internalSN')
    //             ->join("OCRD", "OSCL.customer", "=", "OCRD.cardcode")
    //             ->join("OCRG", "OCRD.GroupCode", "=", "OCRG.GroupCode")
    //             ->whereNotNull('OSCL.U_SchedDate')
    //             //->where("OCRG.GroupName", "LIKE", '%'.$branchName.'%')
    //             ->latest("OSCL.U_SchedDate")
    //             ->take(500)
    //             ->get();
    //     }else{
    //         // Define the SQL query using Laravel's Query Builder
    //         $db = DB::connection("sqlsrv3")->table("OSCL")
    //             ->selectRaw("OINS.custmrName as CustomerName, 
    //                         OINS.street as contactnumber,
    //                         OINS.zip as zip,
    //                         OINS.city as city,
    //                         OINS.country as country,
    //                         OINS.state as state,
    //                         OSCL.U_SchedDate as U_SchedDate,
    //                         OSCL.callID as callID,
    //                         OSCL.subject as subject,
    //                         OCRG.GroupName as branch")
    //             ->join("OINS", 'OSCL.internalSN', '=', 'OINS.internalSN')
    //             ->join("OCRD", "OSCL.customer", "=", "OCRD.cardcode")
    //             ->join("OCRG", "OCRD.GroupCode", "=", "OCRG.GroupCode")
    //             ->whereNotNull('OSCL.U_SchedDate')
    //              ->where("OCRG.GroupName", "LIKE", '%'.$branchName.'%')
    //             ->latest("OSCL.U_SchedDate")
    //             ->take(500)
    //             ->get();
    //     }

    
    
    // $sched2 = calendar1($db);
    // return  array_merge($sched1, $sched2);
 
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
                                "OCLG.Notes",
                                "OCLG.ClgCode"           
                )
                //->latest("OSCL.U_SchedDate")
                ->where("OSCL.callID", $callid)
                ->orderBy("OCLG.ClgCode", "desc")
                //->get()
                ->first();
            if($dd){
                return $dd; 
            } 
        }
        $y = Carbon::now()->year;
        $m = Carbon::now()->month; 
       
        function requestData($y, $m){
            
            # NEW CODE =========================================
            $completed = ['Cancelled','Repaired and Released','Return to Owner (RTO)','Checked up','Installed', 'Repaired', 'Cleaned', 'Surveyed', 'Dismantled', 'Replaced', 'Endorsed to Other ASC'];
            $callid = DB::table("bk_requests")
            ->whereNotNull("callid")
            ->where(function($query) use ($completed) {
                $query->whereNotIn('reason', $completed)
                    ->orWhereNull('reason');
            })
            ->where('status', '!=',10)
            ->whereYear('created_at', $y)
            ->whereMonth('created_at', $m)
            //->where('status', 0)
            ->select("callid")
            // ->where('callid', 'bq1k1015')
            ->get()
            ->toArray();
            return $callid;
        }
        function Times($schedule,$time){
            if($time && $schedule){
                $add = \Carbon\Carbon::parse(sprintf("%04d", $time))->format('H:i:s');
                // $sd =  new carbon($add);
                // $customize =  $sd->addMinutes($index)->toTimeString();
                return  $schedule.' '.$add ;
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
                    if($identify === 7){
                        $val = 1;
                    }else{
                        $val = $identify;
                    }
                }
                else{
                    $val = 1;
                }
                return $val;
        }
        function syncing($call, $c){
               
                //return $callID  =  DB::table("bk_requests")->whereNotNull("callid")->select("callid")->whereNotIn('reason' , $completed)->get()->toArray();
                $sapData = array_filter(array_map(function($sData) {
                    return sapDataConnect($sData->callid);
                }, $call));
                $db = array_filter($sapData);
                //return Response()->json($db);
                #END CODE =========================================
              

                foreach($db as $index=>$up){

                if($up->U_SchedDate){
                    $createDate = date_create($up->U_SchedDate);
                    $schedule = date_format($createDate, "Y-m-d");
                }else{
                    
                    $schedule = NULL;
                }

                $technician = strtoupper($up->techL.', '.$up->techF);

                #FORACCEPT
                if($schedule && $technician && $up->Stat !== 'Closed07' ||  $up->Stat == 'Closed05' ||  $up->Stat == 'Closed06'||  $up->Stat == 'Pending48' ||  $up->Stat == 'Pending15'
                ||  $up->Stat == 'Closed03' ||  $up->Stat == 'Closed08'){
                    DB::table("bk_requests")->where("callid", $up->callID)->update([
                            'installationdate' =>  Times($schedule, $up->comTime),
                            'installer'=> $technician,
                            'notes'=> $up->Notes,
                            'status'=> 1, 
                            'reason'=> $up->reason,
                            'notify'=>  IdentifyNotify($up->callID)
                ]) ; 
                #FOR UNASSIGNED
                }else{
                    DB::table("bk_requests")->where("callid", $up->callID)->update([
                        'installationdate' =>  Times($schedule, $up->comTime),
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
                        'installationdate' =>  Times($schedule, $up->comTime) ,
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
                        'installationdate' =>  Times($schedule, $up->comTime) ,
                        'installer'=> $technician,
                        'notes'=> $up->Notes,
                        'status'=> 10,
                        'reason'=> $up->reason,
                        'notify'=>  IdentifyNotify($up->callID)
                    ]) ;  
                }
                    // if (($index + 1) % $reset_index === 0) {
                    //      $reset_index += 12; // set the next reset index
                    //     $index = $reset_index - 1; // reset the index to the last value of the current sequence
                    // }
                }
                echo "sync-month".'-'.$c;
                return 'sync';
        }
        for ($i = 1; $i <= $m; $i++) {
            $callID = requestData($y,$i);
            syncing($callID, $i);
          
        }
        return 'Done..!';
           
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
    public function exec(request $req){
        function getfields($categories){
            if($categories){
                $type = DB::table("bk_types")->where("ldr", $categories)->get(); 
                return $type;
            }else{
                return "";
            }
         }
         if($req->cat){
            return getfields($req->cat);
         }
        
        $items = DB::table("bk_items")->get();
        $type = DB::table("bk_types")->get(); 
        $brand = DB::table("bk_brand")->get();
        $cat = DB::table("bk_categories")->get();
        
        $arrCust = ['nomodel'=> 1,
                    'model'=> '*NO MODEL',
                    'cat' => $cat,
                    'Brand2'=> $brand,
                    "categories"=> "A",
                    'type'=> "A"];
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
            }else if($req->id == 5){
             return DB::table("bk_property_type")->get();
            }else if($req->id == 6){
                return DB::table("bk_level")->get();
            }else if($req->id == 7){
                return DB::table("bk_location")->get();
            }
            else{
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
        if($req->type == 5){
            $table = "bk_property_type";
        }
        if($req->type == 6){
            $table = "bk_level";
        }
        if($req->type == 7){
            $table = "bk_location";
        }
        if($req->identify == 0){
         
            DB::table($table)->insert([
                "name"=> $req->fields,
                "value"=> $req->fields,
                "identity"=> $req->type,
                "ldr"=>$req->option,
                "created_at"=> date("Y-m-d h:i:s")
            ]);
        }
        if($req->identify == 1){
            DB::table($table)->where("id",$req->id)->update([
                "name"=> $req->fields,
                "value"=> $req->fields,
                "identity"=> $req->type,
                "ldr"=>$req->option,
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
         if($req->type == 5){
            $table = "bk_property_type";
        }
        if($req->type == 6){
            $table = "bk_level";
        }
        if($req->type == 7){
            $table = "bk_location";
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
       
       // NEWPROD
        // $database = [
        //       "ReportsOptn",
        //       "SteadfordReports",
        //       "OutexcelReports",
        //       "AppliantechReports",
        //       "ElectroloopReports",
        //       "ThreathonsReports",
        //       "PanApplianceReports",
        //       "EasyToOwnReports"
        // ];
       // SERVICEPROD
         $database = [
          "SERVICEPROD"
      ];
        function remove($sql){
          $sd = floatval(preg_replace('/[^0-9\.]/', '', $sql)); 
            if($sd == 1){
                return 13;
            }
            if($sd == 1.5){
                return 20;
            }
            if($sd == 2){
                return 27;
            }
            if($sd == 2.5){
                return 33;
            }
            if($sd == 3){
                return 53;
            }
            if($sd == 4){
                return 66;
            }
            if($sd == 5){
                return 78;
            } 
        }
        $results = [];
        foreach ($database as $index => $dbname) {
            $query =  DB::connection($this->dbcontroller('con'.$index.'', $dbname))->table("OITM")
            ->join("OMRC", "OITM.FirmCode", "=","OMRC.FirmCode")
            ->select(\DB::raw("OMRC.FirmName as Brand"), "OITM.ItemName as model", "OITM.FrgnName as categories", "OITM.U_U_Subcat1 as type", "OITM.U_U_Subcat2 as SQM")
            ->orderBy("Brand")
            ->get();
            $results = array_merge($results, $query->toArray());
        }
 
        foreach($results  as $res){
         $check = DB::table("bk_items")->where('model', $res->model)->first();
         if(!$check){
              if($res->model !== 'NO MODEL'){
                $md [] = 'insert kasi wala pa itong item na ito '.$res->model;
                DB::Table("bk_items")->insert([
                    "Brand"=>@$res->Brand,
                    "categories"=>@$res->categories,
                    "type"=>@$res->type,
                    "model"=>@$res->model,
                    "SQM"=>remove(@$res->SQM)
                  ]);
              }
             
         }
           
        }

        return $md;
        return  $db =  DB::connection("sqlsrv3")->table("OSCL")->where('U_CallStatusReason', "Pending05")->get();
    }
    public function testDb(){

 
     
    // return  DB::connection("sqlsrv3")->table("UFD1")->where("TableID", "ASCL")->get();
    //return "Hold";
     
    return $this->syncSapBookingSched();
    return   DB::connection("sqlsrv3")->table("OSCL")
       ->join("OINS", 'OSCL.internalSN', '=', 'OINS.internalSN')
       ->leftJoin("OHEM", 'OSCL.technician', '=', 'OHEM.empID')
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
        //->where('OSCL.U_CallStatusReason','Pending05')
       ->where("OSCL.callID", 137971 )
       // ->whereYear("OSCL.U_SchedDate", '2022')
       // ->whereMonth("OSCL.U_SchedDate", '>=','08')
       ->get();
    }
    public function notify(){
       
        if(\Auth::user()->Branch->id !== 5){  
            return BkRequest::select("callid","requestid","installer","installationdate","reason as status")
            ->where("branch", \Auth::user()->Branch->id)
            ->whereIn('status', [1,2,10])
            ->whereNotNull('notify')->get();

        }else{
            return BkRequest::select("callid","requestid","installer","installationdate","reason as status")
            ->where("branch", \Auth::user()->Branch->id)
            ->where('status', 0)
            ->whereNotNull('notify')->get();
        }
       
       
    }
    
    public function dbug(){

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
                              "OCLG.Notes",
                              "OCLG.ClgCode"           
              )
              //->latest("OSCL.U_SchedDate")
              ->where("OSCL.callID", $callid)
              ->orderBy("OCLG.ClgCode", "asc")
              ->get()
              ->last();
          if($dd){
              return $dd; 
          } 
      }
      # NEW CODE =========================================
      $callID  =  DB::table("bk_requests")->whereNotNull("callid")->select("callid")->take(10)->get()->toArray();
      $sapData = array_filter(array_map(function($sData) {
          return sapDataConnect($sData->callid);
      }, $callID));

      $db = array_filter($sapData);
      return $db;
         //=============================>
        
        $branchid = \Auth::user()->branch_id;
        $branch = DB::table("branches")->where("id", $branchid)->pluck("seriesname")->first();
        //GET STARTING SERIES AT BRANCH
        $getstarting = DB::table("branches")->where("id", $branchid)->pluck("seriesno")->first();
        $ticketno = substr($branch,0,4).'-'.sprintf("%06s",$getstarting+1);

        //UPDATE SERIES AT BRANCH TO USED NEXT SERIES IF INPUT ANOTHER ONE
        DB::table("branches")->where("id", $branchid)->update([
            "seriesno" => sprintf("%06s",$getstarting+1)
        ]);

        return $check = DB::table("bk_requests")->where('ifseries', 1)->where("ticketno", "LIKE", '%'.$branch.'%')->select("ticketno")->get();
         

        return  $ticketno;
        //=============================>>
        // 395116
        // 396671
        // $dd = DB::connection("sqlsrv3")->table("OCLG")->where('parentId', '146411')->get()->last();
        // return  response()->json($dd);
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
                                "OCLG.Notes",
                                "OCLG.ClgCode"         
                )
                //->latest("OSCL.U_SchedDate")
                ->where("OSCL.callID", '146411')
                ->orderBy("OCLG.ClgCode", "asc")
                ->get()
                ->last();
                // foreach($dd as $data){
                //     $note[] = $data->Notes;
                // }
                // $lastNote = end($note);         
                // return response()->json($lastNote);
        return response()->json($dd);
    }
    public function unitfields(){
       $property_type = DB::table("bk_property_type")->get();
       $level = DB::table("bk_level")->get();
       $location = DB::table("bk_location")->get();
       $data = ["propertytype"=>$property_type,
               "level"=>$level,
               "location"=>$location];
       return $data;

    }
    public function print(request $req){
        try {
       $first =  base64_decode(base64_decode(base64_decode(base64_decode($req->print))));
       $id = base64_decode(base64_decode(base64_decode(base64_decode($first))));
       $reqid = explode('-', $id);
        
       $data = BkRequest::with("customer")
            ->with("user")
            ->with("units") 
            ->with("branch")
            ->with("BkJobsUpdate")
            ->where('id', $reqid[0])
            ->first();
        if($data->requesttype == 'REPAIR'){
            $data['inst_tv'] = $data->units[0]->problem == "FOR INSTALLATION"? 1 : 0;
            $data['dsmntl'] = $data->units[0]->problem == "FOR DISMANTLING"? 1 : 0; 
            if($data->units[0]->problem == "FOR DISMANTLING" || $data->units[0]->problem == "FOR INSTALLATION"){
                $data['svc'] = 0;
            }else{
                $data['svc'] = 1;
            }
             
            
        }
        if($data->requesttype == 'SITE SURVEY'){
            $data['svy'] =  1;
        }
        if($data->requesttype == 'INSTALLATION'){
            $data['ins_ac'] = 1;
        }
        if($data->requesttype == 'CLEANING'){
            $data['gc'] = 1;
        }
        if($data->units[0]->warrantycondition == 'WARRANTY'){
            $data['warranty'] = 1;
        }else if($data->units[0]->warrantycondition == 'REPOSSESSED'){
            $data['repo'] = 1;
        }else{
            $data['outofwarranty'] = 1;
        }
        
        $data['customername'] = $data->customer->lastname.' ,'.$data->customer->firstname.' '.$data->customer->middlename;
        $data['branchprint'] = DB::table('branches')->where('id', $data->branch)->pluck('name')->first();
        return view('appletronics_reports.requestform.requestform',compact('data'));
       } catch (\Exception $e) {
        return "Request Not Found..! Please Contact @Stevefox_Linux";
       }
    }

    

    public function uploadadditional(request $req){
        function attachment($attachment_id, $attachment_type, $req){
                  $name = $req->file("file")->getClientOriginalName();
               $checknameexist = DB::table('bk_attachments')->where('name', $attachment_id.'-'.$name)->pluck('name')->first();
            if(!$checknameexist){
                    $path = Storage::disk('appletronics')->putFile('/', $req->file('file'));
                
                    DB::table('bk_attachments')->insert([
                        'attachment_id' => $attachment_id,
                        'attachment_type' => $attachment_type,
                        'attachment_loc' => $path,
                        'name' => $attachment_id.'-'.$name
                ]);
                $getData =  DB::table('bk_attachments')->where('attachment_id', $attachment_id)->get();
                return response()->json(["msg"=>'The File has been Uploaded Successful '.$name, "color"=> 'success', 'data'=>  $getData]);
            }else{
                return response()->json(["msg"=>'The File Already Exist '.$name, "color"=> 'warning']);
            }
        }
        $getID = BkRequest::where('requestid', $req->id)->pluck('id')->first();
         
        return attachment($getID ,1 ,$req);
        
   
    }
    public function storetest(request $req){
        
          
        function attachment($attachment_id, $attachment_type, $req){
            $name = $req->file("file")->getClientOriginalName();
            $checknameexist = DB::table('bk_attachments')->where('name', $attachment_id.'-'.$name)->pluck('name')->first();
                if(!$checknameexist){
                        $path = Storage::disk('appletronics')->putFile('/', $req->file('file'));
                    
                        DB::table('bk_attachments')->insert([
                            'attachment_id' => $attachment_id,
                            'attachment_type' => $attachment_type,
                            'attachment_loc' => $path,
                            'name' => $attachment_id.'-'.$name
                    ]);
                    $getData =  DB::table('bk_attachments')->where('attachment_id', $attachment_id)->get();
                    return response()->json(["msg"=>'The File has been Uploaded Successful '.$name, "color"=> 'success', 'data'=>  $getData]);
                }else{
                    return response()->json(["msg"=>'The File Already Exist '.$name, "color"=> 'warning']);
                }
            }
           
         $checkData = BkRequest::where('requestid', $req->requestid)->pluck('requestid')->first();
        //CUSTOMER
        try{
             
            if(!$checkData){
                  
                $CustomerDATA = new BkCustomerInfo();
                $CustomerDATA->firstname = ucfirst(@$req->firstname);
                $CustomerDATA->lastname  = ucfirst(@$req->lastname);
                $CustomerDATA->middlename  = ucfirst(@$req->middlename);
                $CustomerDATA->barangay  = @$req->barangay;
                 
                $CustomerDATA->region_id  =  $this->regionMap($req->region)['id'];
                 
                $CustomerDATA->region_name  = $this->regionMap($req->region)['name'];
               
                $CustomerDATA->contactperson = @$req->contactperson? @$req->contactperson : 'N/A';
                $CustomerDATA->cpnumber = @$req->cpnumber;
                
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
                // $path = Storage::putFile('BookingSystemAttachments',$req->file("attachment"));
                // $name = $req->file("attachment")->getClientOriginalName();
                $path = Storage::disk('appletronics')->putFile('/', $req->file('attachment'));
                $name = $req->file("attachment")->getClientOriginalName();
                }else{
                $path = $req->attachment;
                $name = $req->attachmentN;
                }
                 
                //REQUEST
                $RequestDATA = new BkRequest();
                $RequestDATA->filename = $name;
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
                $RequestDATA->ifseries = 1;
                $RequestDATA->save();
                 
                
                

                $branchid = \Auth::user()->branch_id;
                $branch = DB::table("branches")->where("id", $branchid)->pluck("sapcode")->first();
                //GET STARTING SERIES AT BRANCH
                $getstarting = DB::table("branches")->where("id", $branchid)->pluck("seriesno")->first();
                $ticketno = substr($branch,0,4).'-'.sprintf("%06s",$getstarting+1);
        
                //UPDATE SERIES AT BRANCH TO USED NEXT SERIES IF INPUT ANOTHER ONE
                DB::table("branches")->where("id", $branchid)->update([
                    "seriesno" => sprintf("%06s",$getstarting+1)
                ]);
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
                    $units->propertytype = @$data->propertytype;
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
                    if($req->file("file")){
                    attachment($RequestDATA->id, 0, @$req);
                    }
                }
                $this->history(0,$req);
                if($req->restoreid){
                    $this->close($req->restoreid);
                }
                 
                return response()->json(['ref'=>$ticketno, 'iden'=>  @$req->identify == 1? 0:5, 'msg' => 'Success']);
            } 
                return response()->json(['ref'=> '', 'iden'=> 1,'msg' => 'File Exist']);
                    }catch(\Exception $e){
                        return response()->json($e);
                    }
                
    }

    public function rebook(request $req){
       //$customerId = DB::table('bk_requests')->where('requestid', $req->id)->pluck('customerid')->first();
      return $data = BkRequest::with("customer")
                        ->with("user")
                        ->with("units")
                        ->with('attachfiles')
                        ->where('requestid',  $req->id)
                        ->get();
                            
    }
    public function rebookrequest(request $req){
        
       
        $getID = BkRequest::where('requestid', $req->rebookid)->first();
        $unitID = BkUnits::where('unitid', $getID->unitid)->pluck('id')->first();
        $customerid = BkRequest::where('requestid', $req->rebookid)->pluck('customerid')->first();
        function attachment($attachment_id, $attachment_type, $req){
            $name = $req->file("file")->getClientOriginalName();
            if($name){
                $checknameexist = DB::table('bk_attachments')->where('name', $attachment_id.'-'.$name)->pluck('name')->first();
                if(!$checknameexist){
                        $path = Storage::disk('appletronics')->putFile('/', $req->file('file'));
                    
                        DB::table('bk_attachments')->insert([
                            'attachment_id' => $attachment_id,
                            'attachment_type' => $attachment_type,
                            'attachment_loc' => $path,
                            'name' => $attachment_id.'-'.$name
                    ]);
                    $getData =  DB::table('bk_attachments')->where('attachment_id', $attachment_id)->get();
                    return response()->json(["msg"=>'The File has been Uploaded Successful '.$name, "color"=> 'success', 'data'=>  $getData]);
                }else{
                    return response()->json(["msg"=>'The File Already Exist '.$name, "color"=> 'warning']);
                }
            }
            }
         $checkData = BkRequest::where('requestid', $req->requestid)->pluck('requestid')->first();
        //CUSTOMER
        try{
                $CustomerDATA = BkCustomerInfo::find($customerid);
                $CustomerDATA->firstname = ucfirst(@$req->firstname);
                $CustomerDATA->lastname  = ucfirst(@$req->lastname);
                $CustomerDATA->middlename  = ucfirst(@$req->middlename);
                $CustomerDATA->barangay  = @$req->barangay;
                $CustomerDATA->region_id  =  $this->regionMap($req->region)['id'];
                $CustomerDATA->region_name  = $this->regionMap($req->region)['name'];
                $CustomerDATA->contactperson = @$req->contactperson? @$req->contactperson : 'N/A';
                $CustomerDATA->cpnumber = @$req->cpnumber;
                $CustomerDATA->emailaddress = @$req->emailaddress?@$req->emailaddress : 'N/A';
                $CustomerDATA->houseno = @$req->houseno?@$req->houseno : 'N/A';
                $CustomerDATA->mcity = @$req->mcity? @$req->mcity : 'N/A';
                $CustomerDATA->organization = @$req->organization? @$req->organization : 'N/A';
                $CustomerDATA->province = @$req->province? @$req->province : 'N/A';
                $CustomerDATA->specialinstruction = @$req->specialinstruction? @$req->specialinstruction : 'N/A';
                $CustomerDATA->street = @$req->street?@$req->street : 'N/A';
                $CustomerDATA->telephoneno = @$req->telephoneno?@$req->telephoneno : 'N/A';
                $CustomerDATA->update();
           
                if(@$req->file("attachment")){
                // $path = Storage::putFile('BookingSystemAttachments',$req->file("attachment"));
                // $name = $req->file("attachment")->getClientOriginalName();
                $path = Storage::disk('appletronics')->putFile('/', $req->file('attachment'));
                $name = $req->file("attachment")->getClientOriginalName();
                }else{
                $path = $req->attachment;
                $name = $req->attachmentN;
                }
                //REQUEST
                $RequestDATA = BkRequest::find($getID->id);
                $RequestDATA->reason = '';
                $RequestDATA->filename = $name;
                $RequestDATA->requestid = @$req->requestid;
                $RequestDATA->requesttype = @$req->requestType;
                $RequestDATA->customerid = @$CustomerDATA->id;
                $RequestDATA->landmark = @$req->landmark;
                $RequestDATA->bookby = @$req->bookby;
                // @$req->identify == 1? 0 : 5
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
                $RequestDATA->ifseries = 1;
                $RequestDATA->update();
                $branchid = \Auth::user()->branch_id;
                $branch = DB::table("branches")->where("id", $branchid)->pluck("sapcode")->first();
                //GET STARTING SERIES AT BRANCH
                $getstarting = DB::table("branches")->where("id", $branchid)->pluck("seriesno")->first();
                $ticketno = substr($branch,0,4).'-'.sprintf("%06s",$getstarting+1);
        
                //UPDATE SERIES AT BRANCH TO USED NEXT SERIES IF INPUT ANOTHER ONE
                DB::table("branches")->where("id", $branchid)->update([
                    "seriesno" => sprintf("%06s",$getstarting+1)
                ]);
                DB::table("bk_requests")->where("id", $RequestDATA->id)->update([
                    "ticketno" => $ticketno
                ]);
                foreach(json_decode($req->units) as $data) {
                
                    $units = BkUnits::find($unitID);
                    $units->unitid = md5($req->requestid);
                    $units->appliancetype = @$data->appliancetype;
                    $units->area = @$data->area;
                    $units->brand = @$data->brand;
                    $units->datepurchase = @$data->datepurchase;
                    $units->deliverydate = @$data->deliverydate;
                    $units->demandreplacement = @$data->demandreplacement;
                    $units->level = @$data->level;
                    $units->location = @$data->location;
                    $units->propertytype = @$data->propertytype;
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
                    $units->update();
                   
                   
                        if($req->file("file")){
                            attachment($RequestDATA->id, 0, @$req);
                        }
                     
                $this->history(1,$req);
                if($req->restoreid){
                    $this->close($req->restoreid);
                }
                $bname = DB::table("branches")->where("id", $branchid)->pluck("name")->first();
                return response()->json(['branch'=>$bname,'ref'=>$ticketno, 'iden'=>  @$req->identify == 1? 0:5, 'msg' => 'Success']);
            } 
                return response()->json(['ref'=> '', 'iden'=> 1,'msg' => 'File Exist']);
                    }catch(\Exception $e){
                        return response()->json($e);
                    }
    }
    

    public function CallIdTracking(request $req){
        
      
           if($req->identify == 1){
            
                return BkRequest::with(['customer'=> function($q){
                    $q->select(\DB::raw("*, CONCAT(lastname, ', ', firstname) as fullname"));
                     }])
                    ->with('attachfiles')
                    ->with("user")
                    ->with("branch")
                    ->with("units")
                    ->with("BkJobsUpdate")->where('callid', $req->callid)
                    ->get();
           }else{
            
               return DB::connection("sqlsrv3")
                    ->table("OCLG")
                    ->leftjoin('OUSR', 'OCLG.AssignedBy', '=', 'OUSR.USERID')
                    ->where('parentId',  $req->callid)
                    ->select('CntctDate as time', 'Notes as message', 'OUSR.U_NAME as from')
                    ->get();
           }
           
            
    }
    public function technicianjob(){
 
         function getInstaller(){
            if(\Auth::user()->branch_id == 5){
               return  DB::table('bk_requests')->whereNotNull('installer')->whereYear('created_at', date("Y"))->select('installer', 'branch')->get();
            }else{
                $branchid = \Auth::user()->branch_id;
                return DB::table('bk_requests')->where('branch', $branchid)->whereNotNull('installer')->whereYear('created_at', date("Y"))->select('installer', 'branch')->get();
            }
            
         }
         function getbranch($id){
            return DB::table('branches')->where('id', $id)->pluck('name')->first();
        }
         
        foreach( getInstaller() as $in){
            $ins[] = $in->installer;
        }
        
        $reason = ['Cancelled','Repaired and Released','Return to Owner (RTO)','Checked up','Installed', 'Repaired', 'Cleaned', 'Surveyed', 'Dismantled', 'Replaced', 'Endorsed to Other ASC'];
        $data = BkRequest::with(['customer'=> function($q){
            $q->select(\DB::raw("*, CONCAT(lastname, ', ', firstname) as fullname"));
        }])
         
        ->with("BkJobsUpdate")
        ->orderby("created_at","DESC")
        ->whereIn('installer', array_unique($ins))
       // ->whereDate('installationdate', '>=', Carbon::now()->addDay()->toDateString())
        ->whereNotIn('reason',  $reason)->get();
        
        foreach($data as $schedule){
            if($schedule['installationdate']){
                $organizer[] = ['color'=> 'green', 'end'=> '', 'name'=>  $schedule['installer'].'/'. getbranch($schedule['branch']), 'start'=> $schedule['installationdate'], 'timed'=>true, 'id'=>$schedule['id'], 'br'=> getbranch($schedule['branch']), 'installer'=> $schedule['installer']];
            }
          
        }
        return $organizer;
    }

    public function customerbook(Request $req){
        return @\Auth::user();

    }
    
    public function phoneuserverify(Request $req){
        function Gentoken($auth){
            $branchuser = DB::table('users')->where('branch_id', $auth)->pluck('email')->first();
            $authController = new AuthController();
            request()->merge([
                'email' => $branchuser,
                'password' => '123!@#',
            ]);
            return $authController->login();
        }
        function branchMap($b){
            return DB::table('branches')->where('name', 'like', '%'.$b.'%')->pluck('id')->first();
        }
        $today = Carbon::now()->toDateString();
        $check = DB::table('self_bookings')
                 ->where('phone', $req->phone)
                 ->where('ipaddress', $req->ipaddress)
                 ->whereDate('created_at', $today)
                 ->where('code', $req->otp)
                 ->first();
        if($check){
             $branches = branchMap(base64_decode(base64_decode(base64_decode(base64_decode($check->token)))));
             if($branches){
                return ['token'=>Gentoken($branches),'data'=>$check];
             }
        }else{
            return "Invalid";
        }
      

        
    }

    public function sendOtp(Request $req){

       $today = Carbon::now()->toDateString();
       $check = DB::table('self_bookings')
                ->where('phone', $req->phone)
                ->where('ipaddress', $req->ipaddress)
                ->whereDate('created_at', $today)
                ->where('status', 0)
                ->first();
       
        if($check){
            if($check->count == 5){
                return 1;
            }
            $new = SelfBooking::where('phone' , $req->phone)
                  ->where('ipaddress', $req->ipaddress)
                  ->first();
        }else{
        $new = new SelfBooking;
        }
        $otp = rand(100000, 999999);
        $new->token = $req->token;
        $new->branch =  $req->branch;
        $new->ipaddress = $req->ipaddress;
        $new->fullname = $req->name;
        $new->phone = $req->phone;
        $new->code = $otp;
        $new->status = 0;
        $new->exp = 5;
    
        if($check){
            $new->count = $check->count + 1;
            $new->update();
            return "update";
        }else{
            $new->count = 1;
            $new->save();
            return "save";
        }
         
        return $req;

    }
    
}
