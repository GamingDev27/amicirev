@php
$class = "fas";
$class .= (strtoupper($device->platform_name) == "WINDOWS"? " fa-laptop" : " fa-mobile-alt")
@endphp
<div class="card bg-light col-lg-3 col-md-6 col-12 px-0">
    <div class="card-header">
        @if($allowEditing)
        <button class="close" aria-label="Close" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span aria-hidden="true">&#8942;</span>
        </button>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item delete-device" href="#" data-toggle="modal" data-target="#deleteDeviceModal"
                data-id="{{ $device->id }}">
                Delete this device</a>

        </div>
        @endif

        <div class="d-flex justify-content-center py-5">
            <i class="{{ $class }}" style="font-size:6rem"></i>
        </div>
    </div>
    <div class="card-body ">
        <h5 class="card-title">{{ $device->platform_name }}</h5>
        <div class="card-text text-muted">{{ $device->updated_at }}</div>
        <div class="card-text text-muted">First Sign-in: {{ $device->created_at }}</div>
    </div>
</div>