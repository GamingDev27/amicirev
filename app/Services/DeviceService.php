<?php

namespace App\Services;

use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

/**
 * DeviceService
 *  - contains all related device actions for Device Model 
 */
class DeviceService
{
    /* verify if device is already in user_devices table */
    public function verifyDeviceInfo()
    {
        $agent = new Agent();
        $device = Device::where('user_id', auth()->user()->id)
            ->where('is_disabled', 0)->first();
        //['uniqid', 'ip_address', 'platform_name_version']
        //fresh login/no registered device yet    
        if (empty($device)) {
            return true;
        }


        if (
            !empty($device) && $device->uniqid != request()->cookie('uniqid')
            && $device->ip_address != request()->ip()
            && $device->flatform_name_version != $agent->platform() . ' v' . $agent->version($agent->platform())
            && $device->device_name_version != $agent->device() . ' v' . $agent->version($agent->device())
        ) {
            return false;
        }


        $this->addUniqidToCookie(auth()->user()->id);
        $withDevice = Device::where('user_id', auth()->user()->id)
            ->where('uniqid', request()->cookie('uniqid'))
            ->active()
            ->exists();

        if (!Session::has('withPrimaryDevice')) {
            Session::put('withPrimaryDevice', $withDevice);
        }
        return true;
    }

    /* store device information when prompted */
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

        Session::put('withPrimaryDevice', true);
        $cookie = Cookie::make('uniqid', $uniqid, 60 * 24 * 90); // 3 months expiration
        Cookie::queue($cookie);
    }


    public function addUniqidToCookie($userId)
    {
        //if cookie does not exist, store cookie and update expiry only for login
        if (empty(request()->cookie('uniqid'))) {
            $device = Device::where('user_id', $userId)
                ->withUniqidOrIP('', request()->ip())
                ->first();

            $uniqid = (!empty($device->uniqid) ? $device->uniqid : Str::random(16));

            //update expiry and uniqid value
            $device->uniqid = $uniqid;
            $device->uniqid_expiry = Carbon::now()->addDays(90);
            $device->save();

            Session::put('withPrimaryDevice', true);
            $cookie = Cookie::make('uniqid', $uniqid, 60 * 24 * 90); // 3 months expiration
            Cookie::queue($cookie);
        }
    }
}
