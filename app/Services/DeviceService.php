<?php

namespace App\Services;

use App\Models\Device;
use Carbon\Carbon;
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
        $device = Device::updateOrCreate(
            ['user_id'          => auth()->user()->id,
             'ip_address'       => request()->ip(),
             'platform_name'    => $agent->platform(),
             'platform_version' => $agent->version($agent->platform()),
             'device_name'      => $agent->device(),
             'device_version'   => $agent->version($agent->device()),
             'browser_name'     => $agent->browser(),
             'browser_version'  => $agent->version($agent->browser()),
            ],['updated_user_id'  => auth()->user()->id, 'updated_at' => Carbon::now()] 
        );
    }
}