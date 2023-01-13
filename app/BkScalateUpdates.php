<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BkScalateUpdates extends Model
{
    public function fromby(){
        return $this->hasMany('App\User', 'id', 'from_by');
    }
}
