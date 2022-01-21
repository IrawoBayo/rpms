<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table='staffs';
    protected $fillable=['subject_id','staff_id_num','staff_name','staff_phone_number','staff_email','staff_phone_number','user_id'];
    protected $primaryKey='staff_id';
    public $timestamps=false;
}
