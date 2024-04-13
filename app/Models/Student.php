<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    const STATUS_NEW = 1;
    const STATUS_VERIFIED = 2;
    const STATUS_DELETED = 3;
    const STATUS_INACTIVE = 4;
    
    public function user(){
      return $this->belongsTo('App\Models\User','auth_user_id');
    }
    
    public function school(){
      return $this->belongsTo('App\Models\School','school_id');
    }

    public function address(){
      return $this->hasOne('App\Models\Address','student_id');
    }
    
    public function scopeFilter($query, array $filters = null){
      if (isset($filters['name'])) {
        $query->where(function ($query) use ($filters) {
            $query->whereRaw('UPPER(first_name) LIKE ?', '%' . strtoupper($filters['name']) . '%')
                 ->orWhereRaw('UPPER(last_name) LIKE ?', '%' . strtoupper($filters['name']) . '%')
                 ->orWhereRaw('UPPER(middle_name) LIKE ?', '%' . strtoupper($filters['name']) . '%')
                 ->orWhereRaw('CONCAT(UPPER(first_name), " ", UPPER(last_name)) LIKE ?', '%'.strtoupper($filters['name']).'%');
        });
      }
    }
}
