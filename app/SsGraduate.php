<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SsGraduate extends Model
{
    protected $fillable=['class_id','student_id_num','student_name','gender','dob','student_email','student_phone_number','lga','state_of_origin','home_address','sponsor_email','sponsor_phone_number'];

    public function class()
    {
        return $this->belongsTo('App\SsClass','class_id');
    }
}
