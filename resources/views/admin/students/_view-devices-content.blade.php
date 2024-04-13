@isset($devices)
@foreach($devices as $index => $device)
<tr>
    <td scope="row" class="text-center d-none">{{ $device->id }}</td>
    <td class="d-flex justify-content-center ">
        <div class="mx-auto">
            <input type="hidden" name="devices[{{$index}}][id]" value="{{$device->id }}"
                id="device_{{$device->id }}_id" />
            <input type="hidden" name="devices[{{$index}}][id]" value="{{$device->id }}"
                id="device_{{$device->id }}_id" />    
            <input type="checkbox" name="devices[{{$index}}][checked]"
                id="device_{{$device->id }}_checked" class="h-100" />
        </div>
    </td>
    <td class="text-center text-nowrap">{{ $device->ip_address }}</td>
    <td class="text-center text-nowrap">{{ $device->platform_name.' ver'.$device->platform_version }}</td>
    <td class="text-center text-nowrap">{{ $device->device_name.' ver'.$device->device_version }}</td>
    <td class="text-center text-nowrap">{{ $device->browser_name.' ver'.$device->browser_version }}</td>
    <td class="text-center col-md-1 ">
        <span
            class="{{ !$device->is_disabled ?'badge badge-pill badge-success':'badge badge-pill badge-secondary'}}">
            {{ !$device->is_disabled ?'ALLOWED':'DISABLED'}}</span>
    </td>    
</tr>
@endforeach  
@endisset
