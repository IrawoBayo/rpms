<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SsForPrincipal extends Model
{
    protected $fillable=['student_id','class_id','subject_id','test_score','exam_score','total','grade','remarks','term','user_id','session_id','obt','ltc','final_cum'];

    public function subjects()
    {
        return $this->belongsTo('App\SsSubject','subject_id');
    }

    public function classes()
    {
        return $this->belongsTo('App\SsClass','class_id');
    }

    public function students()
    {
        return $this->belongsTo('App\SsStudent','student_id');
    }
}
