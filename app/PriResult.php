<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriResult extends Model
{
    protected $fillable=['student_id','class_id','subject_id','test_score','exam_score','total','grade','remarks','term','user_id','session_id','obt','ltc','final_cum'];

    public function subjects()
    {
        return $this->belongsTo('App\PriSubject','subject_id');
    }

    public function classes()
    {
        return $this->belongsTo('App\PriClass','class_id');
    }

    public function students()
    {
        return $this->belongsTo('App\PriStudent','student_id');
    }
}
