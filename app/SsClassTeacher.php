<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SsClassTeacher extends Model
{
    protected $fillable=['class_id','user_id'];

    public function classes()
    {
        return $this->belongsTo('App\SsClass','class_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
