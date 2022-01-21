<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    protected $table='subject_teachers';
    protected $fillable=['subject_id','user_id'];

    public function subjects()
    {
        return $this->belongsTo('App\Subject','subject_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
