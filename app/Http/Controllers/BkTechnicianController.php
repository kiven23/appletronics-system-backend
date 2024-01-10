<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\BkRequest;
use App\BkUnits;
use Carbon\Carbon;
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
            ->where('installer', 'SATURNO, KELLY')
            // SCHEDULE TODAY PENDING
            ->when($i == 1, function ($query) use ($e, $n) {
                    return $query->whereDate('installationdate', $e)->whereNotIn('reason' , $n);
            }) 
            // SCHEDULE NEXT DAY UNASSIGNED
            ->when($i == 0, function ($query) use ($e, $n) {
                    return $query->whereDate('installationdate', '>=', $e)->whereNotIn('reason' , $n);   
            })
            ->when($i == 2, function ($query) use ($e, $n) {
                return $query->whereIn('reason' , $n);   
            })
            ->when($i == 3, function ($query) use ($e, $n) {
                return $query->whereIn('reason' , $n);   
            })
            ->when($i == 4, function ($query) use ($e) {
                return $query->whereDate('installationdate', $e);
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
       //UNASSIGNED DATE NEXT DAY
        $data['unassigned'] = count(check(Carbon::now()->addDay()->toDateString(), 0, listing(0)));
       //PENDING DATE NOW
        $data['pending'] =  count(check(Carbon::now()->toDateString(),1, listing(1)));
       //COMPLETED
        $data['completed'] =  count(check(Carbon::now()->toDateString(),2, listing(2)));
       //CANCELLED
        $data['cancelled'] =  count(check(Carbon::now()->toDateString(),3, listing(3)));
       //TOTAL JOBS 
        $data['totaljobs'] = ['asof'=> Carbon::now()->format('M d, Y'), 'count'=> count(check(Carbon::now()->toDateString(),4, ''))];
       //TECHNICIAN LIST
        $data['technician'] = technician();
        $requestedValue = $req->state;
        $all = ['count'=> $data, requested($requestedValue, listing($requestedValue))];
        return $all;
    }
    
    
}
 