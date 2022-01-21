<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriClassTeacher extends Model
{
    protected $fillable=['class_id','user_id'];

    public function classes()
    {
        return $this->belongsTo('App\PriClass','class_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
