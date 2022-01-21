<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyClass extends Model
{
    protected $table='classes';
    protected $fillable=['class_name','class_name_num','section','active'];
    protected $primaryKey='class_id';
    public $timestamps=false;
}
