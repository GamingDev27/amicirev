<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LiveStreamLink extends Model
{
    use HasFactory;
    protected $table = 'livestreamlink';

    public function season()
    {   
        if ($this->season_id === 0) {
            return "All Branches"; 
        }

        return $this->hasOne(Season::class, 'id', 'season_id');
    }

    public function getDateStreamHumanAttribute()
    {
        return Carbon::parse($this->date_stream)->format('F j, Y g:i A');
        
    }
}
