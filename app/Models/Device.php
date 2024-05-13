<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'user_devices';
    protected $guarded = [];


    /**
     * Relationships
     *
     * @return void
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function getPlatformNameVersionAttribute($value)
    {
        return "{$this->platform_name} v{$this->platform_version}";
    }

    public function getDeviceNameVersionAttribute($value)
    {
        return "{$this->device_name} v{$this->device_version}";
    }

    /**
     * localscopes
     *
     * @return void
     */
    public function scopeFilter($query, array $filters = null)
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
                $query->where('is_disabled', $filters['is_disabled']);
            });
        }
    }

    public function scopeActive($query)
    {
        return $query->where('uniqid_expiry', '>=', Carbon::now());
    }

    /* use to check if the uniqid from cookie or ip address is in user_devices */
    public function scopewithUniqidOrIP($query, $uniqid, $requestIP)
    {
        return $query->where(function ($query) use ($uniqid, $requestIP) {
            $query->where('uniqid', $uniqid)
                ->orWhere('ip_address', $requestIP);
        });
    }
}
