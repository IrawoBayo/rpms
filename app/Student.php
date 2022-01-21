<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table='students';
    protected $fillable=['class_id','student_id_num','student_name','gender','dob','student_email','student_phone_number','lga','state_of_origin','home_address','sponsor_email','sponsor_phone_number','image'];
    protected $primaryKey='student_id';
    public $timestamps=false;

    public function class()
    {
        return $this->belongsTo('App\MyClass','class_id');
    }
}
