<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'user_devices';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id','user_id');
    }

    public function scopeFilter($query, array $filters=null)
    {
        if (isset($filters['platform'])) {
            $query->where(function ($query) use ($filters) {
                $query->where('platform_name', 'like', '%' . $filters['platform'] . '%');
            });
        }
        if (isset($filters['device'])) {
            $query->where(function ($query) use ($filters) {
                $query->where('device_name', 'like', '%' . $filters['device'] . '%');
            });
        }
        if (isset($filters['browser'])) {
            $query->where(function ($query) use ($filters) {
                $query->where('browser_name', 'like', '%' . $filters['browser'] . '%');
            });
        }
        if (isset($filters['is_disabled'])) {
            $query->where(function ($query) use ($filters) {
                $query->where('is_disabled', $filters['is_disabled'] );
            });
        }
        
    }
}
