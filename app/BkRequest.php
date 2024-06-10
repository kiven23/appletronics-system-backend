<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BkRequest extends Model
{
    public function customer()
    {
        return $this->hasOne(BkCustomerInfo::class, 'id', 'customerid');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid');
    }
    public function branch()
    {
        return $this->hasOne(Branch::class, 'id', 'branch');
    }
    public function units()
    {
        return $this->hasMany(BkUnits::class, 'unitid', 'unitid');
    }
    public function BkJobsUpdate(){
        return $this->hasMany(BkJobsUpdate::class, 'requestid', 'requestid');
    }
    public function attachfiles(){
        return $this->hasMany(BkAttachment::class, 'attachment_id', 'id');
    }
}
