<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $platforms    = Device::distinct('platform_name')->get('platform_name');;
        $devices_name = Device::distinct('device_name')->get('device_name');
        $browsers     = Device::distinct('browser_name')->get('browser_name');

        $query = Device::filter(request(['platform', 'device', 'browser', 'is_disabled']));

        $query->with(["user.student" => function ($query) {
            $query->filter(request(['name']));
        }])->whereHas("user.student", function ($query) {
            $query->filter(request(['name']));
        });
        $query->latest();

        $devices = $query->paginate(15)->onEachSide(3);

        return view('admin.devices.index', compact(['devices', 'platforms', 'devices_name', 'browsers']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id = null)
    {
        $deviceIds = [];
        if (isset($request->devices)) {
            foreach ($request->devices as $device) {
                if (isset($device['checked']) && $device['checked'] == "on")
                    $deviceIds[] = $device['id'];
            }
        }

        //if is_disabled = 1, disable access
        if ($deviceIds) {
            $query = Device::whereIn('id', $deviceIds)
                ->update(['is_disabled' => $request->is_disabled, 'updated_user_id' => auth()->id()]);
        }

        return back()->with('success', 'Device updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = Device::latest()->where('user_id', $id);

        $devices = $query->with("user.student")->get();

        return view('admin.students._view-devices-content', compact('devices'));
    }
}
