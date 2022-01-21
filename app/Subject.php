<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model


{
    protected $table='subjects';
    protected $fillable=['subject_name','subject_code','active'];
    protected $primaryKey='subject_id';
    public $timestamps=false;

}
