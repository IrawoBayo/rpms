<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriTeacherRemark extends Model
{
    protected $fillable = [
        'session_id', 'term', 'class_id', 'student_id', 'remark'
    ];
}
