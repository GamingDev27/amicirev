<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Services\DeviceService;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    protected $userDeviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->userDeviceService = $deviceService;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id = null)
    {
        $this->userDeviceService->storeDeviceInfo();

        return back()->with('success', 'Device saved!');
    }
}
