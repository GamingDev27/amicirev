<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
use Str;

class AllowDevice
{
    /**
     * Verify if the device use to login is not tagged as disabled by
     * administrator and is in user_devices table
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();
        $user = Auth::user();
        $uniqid = $request->cookie('uniqid');



        $device = Device::where('user_id', $user->id)
            ->where('uniqid', $uniqid)
            ->where('platform_name', $agent->platform())
            ->first();

        //device disabled, redirect to login page with error
        if ($device && $device->is_disabled) {
            Session::flush();
            Auth::logout();
            return redirect('login')->with('error', 'Your device is not allowed to access this page. Contact Amici Review Center to enable your device');
        }

        //get cookie for uniqid

        $device = Device::where('user_id', $user->id)
            ->where('is_disabled', 0)->first();

        //fresh login/no device registered yet, allow bypass
        if (empty($device)) {
            return $next($request);
        }

        return $next($request);
    }
}
