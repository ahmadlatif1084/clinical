<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    public function visit(){
        return $this->belongsToMany(Visit::class);
    }
    //
}
