<?php

namespace App\Http\Controllers;

use App\Connections;
use App\Device;
use App\Signal;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{

    public function deviceReg(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ipaddr' => 'ip',
            'location' => 'required|string'
        ]);

        if($validator->fails()) {
            return response($validator->error()->all(), 403);
        }

        $key = md5(time(0));

        if($device = Device::create($request->all())) {
            $device->appkey = $key;
            $device->save();
            $device->signal()->save((new Signal()));
            return response($device);
        }

        return response('Failed to register device', 403);
    }

    public function smokeSense($appKey, $sense)
    {
        $device = Device::where('appkey', $appKey)->first();

        if(!$device->id)
            return response('device not found', 403);

        $signal = new Signal(['sense' => $sense]);

        $signal = $device->signal;
        $signal->sense = $sense;

        if($signal->save()) {
            return response('request successful');
        }

        return response('signal not processed', 403);
    }

    public function connectSense($appKey, $batt)
    {
        $device = Device::where('appkey', $appKey)->first();

        if(!$device->id)
            return response('device not found', 403);

        $connection = new Connections(['batt' => $batt]);

        if($device->connections()->save($connection)) {
            return response('request successful');
        }

        return response('connect sense not processed', 403);
    }
}
