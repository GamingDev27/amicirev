<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public function province(){
        return $this->belongsTo('App\Models\Province','province_id');
    }

    public function city(){
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function barangay(){
        return $this->belongsTo('App\Models\Barangay','barangay_id');
    }

      
}
