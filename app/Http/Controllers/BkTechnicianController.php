<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\BkRequest;
use App\BkUnits;
use Carbon\Carbon;
use App\BkTechnician;

class BkTechnicianController extends Controller
{
    public function myjob(request $req){
        function listing($v){
            $notlisted = [];
            $cancelled = ['Cancelled'];
            $completed = ['Repaired and Released','Return to Owner (RTO)','Checked up','Installed', 'Repaired', 'Cleaned', 'Surveyed', 'Dismantled', 'Replaced', 'Endorsed to Other ASC'];
            if($v == 3){
               return $cancelled;
            }else if($v == 2){
               return $completed;
            }else if($v == 1){
               return array_merge($notlisted, $cancelled, $completed);
            }else{
               return array_merge($notlisted, $cancelled, $completed);
            }
        }
       function technician(){
                return DB::connection("sqlsrv3")->table("OHEM")
                ->select('lastName','firstName')
                ->join('hem6', 'OHEM.empid', '=', 'hem6.empid')
                ->where('hem6.roleid', -2)
                ->where('OHEM.Active', 'Y')
                
                ->get();
       }
         
       function check($e, $i, $n){
            return $data = BkRequest::with(['customer'=> function($q){
                $q->select(\DB::raw("*, CONCAT(lastname, ', ', firstname) as fullname"));
            }])
            ->with("user")
            ->with("branch")
            ->with("units")
            ->with("BkJobsUpdate")
            ->orderby("created_at","DESC")
            ->where('installer', 'LAGUNA, FERNANDO')
            // SCHEDULE TODAY PENDING
            ->when($i == 1, function ($query) use ($e, $n) {
                    return $query->whereDate('installationdate', $e)->whereNotIn('reason' , $n);
            }) 
            // SCHEDULE NEXT DAY UNASSIGNED
            ->when($i == 0, function ($query) use ($e, $n) {
                    return $query->whereNotIn('reason' , $n);   
            })
            ->when($i == 2, function ($query) use ($e, $n) {
                return $query->whereIn('reason' , $n);   
            })
            ->when($i == 3, function ($query) use ($e, $n) {
                return $query->whereIn('reason' , $n);   
            })
            ->when($i == 4, function ($query) use ($e, $n) {
                return $query->whereDate('installationdate', $e)->whereNotIn('reason' , $n);
            }) 
            ->when($i == 5, function ($query) use ($e, $n) {
                return $query->whereDate('installationdate', $e)->whereNotIn('reason' , $n)->where('requesttype', 'REPAIR');
            })
            ->when($i == 6, function ($query) use ($e, $n) {
                return $query->whereDate('installationdate', $e)->whereNotIn('reason' , $n)->where('requesttype', 'INSTALLATION');
            })
            ->when($i == 7, function ($query) use ($e, $n) {
                return $query->whereDate('installationdate', $e)->whereNotIn('reason' , $n)->where('requesttype', 'SITE SURVEY');
            })
            ->when($i == 8, function ($query) use ($e, $n) {
                return $query->whereDate('installationdate', $e)->whereNotIn('reason' , $n)->where('requesttype', 'CLEANING');
            })
            ->when($i == 9, function ($query) use ($e, $n) {
                return $query->whereDate('installationdate', $e)->whereNotIn('reason' , $n)->where('reason', 'Dismantled');
            })
            ->get();
       }
       
        function requested($r,$v){
            if($r == 0){
                return check(Carbon::now()->addDay()->toDateString(), 0, $v); 
            }else if($r == 1){
                return check(Carbon::now()->toDateString(),1, $v);
            }else if($r == 2){
                return check(Carbon::now()->toDateString(),2, $v);
            }else if($r == 3){
                return check(Carbon::now()->toDateString(),3, $v);
            }else{
                return check(Carbon::now()->addDay()->toDateString(), 0, $v) ;
            } 
        }
        function barchart(){
            $today = Carbon::now()->toDateString();
            $firstDayOfMonth = Carbon::parse($today)->firstOfMonth();

            for ($date = $firstDayOfMonth; $date->lessThanOrEqualTo(Carbon::now()); $date->addDay()) {
                // Inside the loop, $date now represents each day from the first day of the month to the current date
                $dd[]= new Carbon($date->format('M d, Y'));
            }
            foreach($dd as $date){
               $d[] = count(check($date->toDateString(),1, listing(1)));
            }
            return $d;
        }
           
       //UNASSIGNED DATE NEXT DAY
        $data['unassigned'] = count(check(0, 0, listing(0)));
       //PENDING DATE NOW
        $data['pending'] =  count(check(Carbon::now()->toDateString(),1, listing(1)));
       //COMPLETED
        $data['completed'] =  count(check(Carbon::now()->toDateString(),2, listing(2)));
       //CANCELLED
        $data['cancelled'] =  count(check(Carbon::now()->toDateString(),3, listing(3)));
       //TOTAL JOBS 
        $data['totaljobs'] = ['asof'=> Carbon::now()->format('M d, Y'), 'count'=> count(check(Carbon::now()->toDateString(),4, listing(1)))];
       //TECHNICIAN LIST
        $data['technician'] = technician();
        $data['dashboard']= ["service"=> count(check(Carbon::now()->toDateString(),5, listing(1))),
                             "installation"=> count(check(Carbon::now()->toDateString(),6, listing(1))),
                             "survey"=> count(check(Carbon::now()->toDateString(),7, listing(1))),
                             "dismantling"=> count(check(Carbon::now()->toDateString(),9, listing(1))),
                             "system"=> 0,
                             "cleaning"=> count(check(Carbon::now()->toDateString(),8, listing(1))),
                             "asof"=> Carbon::now()->format('M d, Y H:i:s'),
                             "piechart" => ["service"=> count(check(Carbon::now()->toDateString(),2, listing(2))->where('requesttype', 'REPAIR')),
                                            "installation"=> count(check(Carbon::now()->toDateString(),2, listing(2))->where('requesttype', 'INSTALLATION')),
                                            "survey"=> count(check(Carbon::now()->toDateString(),2, listing(2))->where('requesttype', 'SITE SURVEY')),
                                            "dismantling"=> count(check(Carbon::now()->toDateString(),2, listing(2))->where('requesttype', 'Dismantled')),
                                            "system"=> 0,
                                            "cleaning"=> count(check(Carbon::now()->toDateString(),2, listing(2))->where('requesttype', 'CLEANING'))],
                             "barchart"=> barchart()];
 
        $requestedValue = $req->state;
        $all = ['count'=> $data, requested($requestedValue, listing($requestedValue))];
        return $all;
    }
    public function dashboard(){

    }
    public function calendar(){
        
        $reason = ['Cancelled','Repaired and Released','Return to Owner (RTO)','Checked up','Installed', 'Repaired', 'Cleaned', 'Surveyed', 'Dismantled', 'Replaced', 'Endorsed to Other ASC'];
        $data = BkRequest::with(['customer'=> function($q){
            $q->select(\DB::raw("*, CONCAT(lastname, ', ', firstname) as fullname"));
        }])
         
        ->with("BkJobsUpdate")
        ->orderby("created_at","DESC")
       ->where('installer', 'LAGUNA, FERNANDO')
       // ->whereDate('installationdate', '>=', Carbon::now()->addDay()->toDateString())
        ->whereNotIn('reason',  $reason)->get();
        
        foreach($data as $schedule){
            if($schedule['installationdate']){
                $organizer[] = ['color'=> 'green', 'end'=> '', 'name'=>  '#'.$schedule['callid'], 'start'=> $schedule['installationdate'], 'timed'=>true, 'id'=>$schedule['id']];
            }
          
        }
        return $organizer;


    }
    public function insert(request $req){
       
        $creatorID = $req->data['callid'].'-'.md5($req->data['techname']).'-'.md5($req->data['type']);
        $checkCreator = DB::table('bk_technicians')->where('creator_id', $creatorID)->pluck('creator_id')->first();
       if(!$checkCreator){
        $insert = new BkTechnician;
        $insert->callid = $req->data['callid'];
        $insert->creator_id =  $creatorID;
        $insert->type = $req->data['type'];
        $insert->status = 0;

        $insert->totech = @$req->data['actions']['info']['totech'];
        $insert->reason = @$req->data['actions']['info']['reason'];
        $insert->remarks = @$req->data['actions']['info']['remarks'];
        $insert->escalateto = @$req->data['actions']['info']['escalateto'];
        $insert->scheduledate = @$req->data['actions']['info']['scheduledate'];
        $insert->save();
        $M = ['msg'=> 'Successful Sent TRACK#'.$insert->creator_id , 'color'=> 'success', 'track'=> $checkCreator];
       } else {
        $M = ['msg'=> 'Already Added TRACKID#'.$checkCreator, 'color'=> 'warning', 'track'=> $checkCreator];
       } 
       return $M;
        
        
    }
    public function adminQueue(){
        return DB::table('bk_technicians')->where('status', 0)->get();
    }
    
    
}
 