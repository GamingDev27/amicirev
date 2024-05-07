<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;

class AllowDevice
{
    /**
     * Verify if the device use to login is not tagged as disabled by
     * administrator
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();
        $user = Auth::user();
        $device = Device::where('user_id', $user->id)
            ->where('ip_address',       request()->ip())
            ->where('platform_name',    $agent->platform())
            ->where('platform_version', $agent->version($agent->platform()))
            ->where('device_name',      $agent->device())
            ->where('device_version',   $agent->version($agent->device()))
            ->where('browser_name',     $agent->browser())
            ->where('browser_version',  $agent->version($agent->browser()))
            ->first();

        if (empty($device)) {
            // Session::flush();
            // Auth::logout();
            // return redirect('login')->with('error', 'Device not found');
            return $next($request);
        }

        if ($device->is_disabled) {
            Session::flush();
            Auth::logout();
            return redirect('login')->with('error', 'Your device is not allowed to access this page. Contact Amici Review Center to enable your device');
        }

        return $next($request);
    }
}
