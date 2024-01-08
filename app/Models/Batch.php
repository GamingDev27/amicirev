<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Season;
use App\Models\Clas;
class Batch extends Model
{
    use HasFactory;
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
	
	public function classes()
    {
        return $this->hasMany(Clas::class);
    }
}
