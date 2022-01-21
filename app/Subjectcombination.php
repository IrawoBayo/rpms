<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjectcombination extends Model
{
    protected $table='subjectcombinations';
    protected $fillable=['class_id','subject_id'];
    protected $primaryKey='subjectcombination_id';
    public $timestamps=false;
}
