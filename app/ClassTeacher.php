<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    protected $table='class_teachers';
    protected $fillable=['class_id','user_id'];

    public function classes()
    {
        return $this->belongsTo('App\MyClass','class_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
