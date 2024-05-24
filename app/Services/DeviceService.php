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
        $user_platform = $agent->platform();
        $user_ipaddress = request()->ip();

        /************************
         * If there is an uniqid first and found in table, allow login
         *************************/
        $device = Device::where('user_id', auth()->user()->id)
            ->where('uniqid', request()->cookie('uniqid'))
            ->where('platform_name', $user_platform)
            ->active()->first();
        if ($device) {
            $this->storeSession($device, $agent);
            return true;
        }
        //END 

        /************************
         * If no uniqid found, verify if another device exists
         *************************/
        $device = Device::where('user_id', auth()->user()->id)
            ->where('platform_name', $user_platform)
            ->where('ip_address', $user_ipaddress)
            ->where('is_disabled', 0)
            ->first();
        if (!$device) {
            $device = Device::where('user_id', auth()->user()->id)
                ->where(function ($query) use ($user_platform, $user_ipaddress) {
                    $query->where('platform_name', $user_platform)
                        ->OrWhere('ip_address', $user_ipaddress);
                })
                ->first();
        }
        if (!$device) {
            //allowed login and enable adding of new device
            return true;
        }
        //check if another device exist and is currently not disabled
        if (($device->platform_name !== $agent->platform() || $device->ip_address !== request()->ip()) && $device->is_disabled == 0) {
            return false;
        }


        $uniqid = $this->addUniqidToCookie(auth()->user()->id, $user_platform);
        $device = Device::where('user_id', auth()->user()->id)
            ->where('uniqid', ($uniqid ? $uniqid : request()->cookie('uniqid')))
            ->active()->first();

        //update ip/device/platform use in the current signin
        if ($device) {
            $this->storeSession($device, $agent);
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


    public function addUniqidToCookie($userId, $platform)
    {
        //if cookie does not exist, store cookie and update expiry only for login
        if (empty(request()->cookie('uniqid'))) {
            $device = Device::where('user_id', $userId)
                ->where('platform_name', $platform)
                ->where('is_disabled', 0)
                ->withUniqidOrIP('', request()->ip())
                ->first();

            if (!$device) {
                return null;
            }

            $uniqid = (!empty($device->uniqid) ? $device->uniqid : Str::random(16));

            //update expiry and uniqid value
            $device->uniqid = $uniqid;
            $device->uniqid_expiry = Carbon::now()->addDays(90);
            $device->save();

            Session::put('withPrimaryDevice', true);
            $cookie = Cookie::make('uniqid', $uniqid, 60 * 24 * 90); // 3 months expiration
            Cookie::queue($cookie);
            return $uniqid;
        }
        return null;
    }

    public function storeSession(Device $device, Agent $agent)
    {
        // $device->fill([
        //     'ip_address' => request()->ip(),
        //     'device_name' => $agent->device(), 'device_version' => $agent->version($agent->device())
        // ]);
        // $device->save();

        if (!Session::has('withPrimaryDevice')) {
            Session::put('withPrimaryDevice', $device->exists());
        }
    }
}
