<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForPrincipal extends Model
{
    protected $fillable=['student_id','class_id','subject_id','test_score','exam_score','total','grade','remarks','term','user_id','session_id','obt','ltc','final_cum'];
    protected $primaryKey='result_id';
    public $timestamps=false;

    public function subjects()
    {
        return $this->belongsTo('App\Subject','subject_id');
    }

    public function classes()
    {
        return $this->belongsTo('App\MyClass','class_id');
    }

    public function students()
    {
        return $this->belongsTo('App\Student','student_id');
    }

    public function sessions()
    {
        return $this->belongsTo('App\Session','session_id');
    }
}
