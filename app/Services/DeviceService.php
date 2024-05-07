<?php

namespace App\Services;

use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

/**
 * DeviceService
 *  - contains all related device actions for Device Model 
 */
class DeviceService
{

    public function storeDeviceInfo()
    {
        $agent = new Agent();
        $uniqid = Str::random(16);
        $device = Device::updateOrCreate(
            [
                'user_id'          => auth()->user()->id,
                'ip_address'       => request()->ip(),
                'platform_name'    => $agent->platform(),
                'platform_version' => $agent->version($agent->platform()),
                'device_name'      => $agent->device(),
                'device_version'   => $agent->version($agent->device()),
                'browser_name'     => $agent->browser(),
                'browser_version'  => $agent->version($agent->browser()),
            ],
            [
                'uniqid' => $uniqid,
                'uniqid_expiry'    => Carbon::now()->addDays(90),
                'updated_user_id'  => auth()->user()->id,
                'updated_at' => Carbon::now()
            ]
        );

        $cookie = Cookie::make('uniqid', $uniqid, 60 * 24 * 90); // 60 minutes expiration
        Cookie::queue($cookie);
    }
}
