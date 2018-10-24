<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    public function appointment(){

        return $this->hasOne(Appointment::class);
    }

    public function multipleappointment(){

        return $this->hasMany(Appointment::class);
    }
    //
}
