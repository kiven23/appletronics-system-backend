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
class BkRequestController extends Controller
{
    public function store(request $req){
       //CUSTOMER
       $CustomerDATA = new BkCustomerInfo();
       $CustomerDATA->firstname =  $req->firstname;
       $CustomerDATA->lastname  = $req->lastname;
       $CustomerDATA->middlename  = $req->middlename;
       $CustomerDATA->barangay  = $req->barangay;
       $CustomerDATA->contactperson = $req->contactperson;
       $CustomerDATA->cpnumber = $req->cpnumber;
       $CustomerDATA->emailaddress = $req->emailaddress;
       $CustomerDATA->houseno = $req->houseno;
       $CustomerDATA->mcity = $req->mcity;
       $CustomerDATA->organization = $req->organization;
       $CustomerDATA->province = $req->province;
       $CustomerDATA->specialinstruction = $req->specialinstruction;
       $CustomerDATA->street = $req->street;
       $CustomerDATA->telephoneno = $req->telephoneno;
       $CustomerDATA->save();
       $path = Storage::putFile('BookingSystemAttachments',$req->file("attachment"));
       //REQUEST
        $RequestDATA = new BkRequest();
        $RequestDATA->requestid = $req->requestid;
        $RequestDATA->requesttype = $req->requestType;
        $RequestDATA->customerid = $CustomerDATA->id;
        $RequestDATA->branch = \Auth::user()->branch_id;
        $RequestDATA->userid = \Auth::user()->id;
        $RequestDATA->unitid = md5($req->requestid); 
        $RequestDATA->attachment = $path;
        $RequestDATA->additionalrequest1 = $req->additionalrequest1;
        $RequestDATA->additionalrequest2 = $req->additionalrequest2;
        $RequestDATA->specialinstruction = $req->specialinstruction;
        $RequestDATA->save();
        foreach(json_decode($req->units) as $data) {

            $units = new BkUnits;
            $units->unitid = md5($req->requestid);
            $units->appliancetype = @$data->appliancetype;
            $units->area = @$data->area;
            $units->brand = @$data->brand;
            $units->datepurchase = @$data->datepurchase;
            $units->deliverydate = @$data->demandreplacement;
            $units->demandreplacement = @$data->demandreplacement;
            $units->level = @$data->level;
            $units->location = @$data->location;
            $units->locationofinstallation = @$data->locationofinstallation;
            $units->model = @$data->model;
            $units->paidamoun = @$data->paidamoun;
            $units->priority = @$data->priority;
            $units->prodcategories = @$data->prodcategories;
            $units->qty = @$data->qty;
            $units->serialno = @$data->serialno;
            $units->time  = @$data->time;
            $units->unitcondition = @$data->unitcondition;
            $units->wallfinish = @$data->wallfinish;
            $units->warrantycondition = @$data->warrantycondition;
            $units->withpowersupply = @$data->withpowersupply;
            $units->save();
        }
        return response()->json($req);
    }
}
