<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BkScalate extends Model
{
    public function threads(){
        return $this->hasMany('App\BkScalateUpdates', 'scalate_id', 'id');
    }
  
}
