<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clas extends Model
{
    protected $table = 'classes';
    use HasFactory;
	
	public function batch(){
        return $this->belongsTo('App\Models\Batch','batch_id');
    }

    public function course(){
        return $this->belongsTo('App\Models\Course','course_id');
    }

    public function subject(){
        return $this->belongsTo('App\Models\Subject','subject_id');
    }

    public function coach(){
        return $this->belongsTo('App\Models\Coach','coach_id');
    }

    public function attachments(){
        return $this->hasMany('App\Models\ClasAttachment','class_id');
    }

}
