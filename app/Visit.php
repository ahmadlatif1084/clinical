<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public function medication(){
        return $this->belongsToMany(Medication::class);
    }
    public function diagnose(){
        return $this->belongsToMany(Diagnose::class);
    }
    //
}
