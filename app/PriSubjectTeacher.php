<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriSubjectTeacher extends Model
{
    protected $fillable=['subject_id','user_id'];

    public function subjects()
    {
        return $this->belongsTo('App\PriSubject','subject_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
