@extends('layouts.admin')

@section('content')
<div class="mt-4 mb-4">
    <form action="{{ route('view_devices')}}" method="GET" role="devices">
        @csrf
        <div class="form-row gy-2">
            <div class="col-12">
                <h4 class="border-bottom pb-3 mb-4">Allowed Devices</h4>
            </div>
            <div class="accordion px-2 col-12" id="filterMain">
                <div class="card">
                    {{-- Header --}}
                    <div class="card-header p" id="filterHeader">
                        <h2 class="m-0">
                            <span class="btn btn-link btn-block text-left font-weight-bold text-dark">
                                Filters
                            </span>
                        </h2>
                    </div>
                    {{-- BODY --}}
                    <div class="card-body ">
                        <div class="d-flex flex-column flex-lg-column-reverse">
                            <div class="form-row">
                                <div class="input-group col-12 col-md-6 col-lg-3 mb-1">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Search Name" value="{{
										request('name') }}">
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-1">
                                    <select type="text" class="form-control form-select-clear" name="platform">
                                        <option value=""><em>--PLATFORM--</em></option>
                                        @foreach ($platforms as $platform)
                                        <option value="{{ $platform->platform_name }}" {{ request('platform')==$platform->platform_name ? 'selected' : '' }}>{{ $platform->platform_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-1">
                                    <select type="text" class="form-control form-select-clear" name="device">
                                        <option value=""><em>--DEVICES--</em></option>
                                        @foreach ($devices_name as $device_name)
                                        <option value="{{ $device_name->device_name }}" {{ request('device')==$device_name->device_name ? 'selected' : '' }}>{{ $device_name->device_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-1">
                                    <select type="text" class="form-control form-select-clear" name="browser">
                                        <option value=""><em>--BROWSERS--</em></option>
                                        @foreach ($browsers as $browser)
                                        <option value="{{ $browser->browser_name }}" {{ request('browser')==$browser->browser_name ? 'selected' : '' }}>{{ $browser->browser_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-1">
                                    <select type="text" class="form-control form-select-clear" name="is_disabled">
                                        <option value=""><em>--STATUS--</em></option>
                                        <option value="0" {{ request('is_disabled')=='0' ? 'selected' : '' }}>ALLOWED
                                        </option>
                                        <option value="1" {{ request('is_disabled')=='1' ? 'selected' : '' }}>DISABLED
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row justify-content-end mb-lg-2">
                                <div class="col-12 col-lg-2 col-xl-1 mb-1">
                                    <button type="submit" class="btn btn-primary btn-block" id="filterBtn"><i
                                            class="fas fa-filter"></i>
                                        Filter</button>
                                </div>
                                <div class="col-12 col-lg-2 col-xl-1 mb-1">
                                    <button type="button" class="btn btn-outline-secondary btn-block"
                                        id="clearFilter"><i class="far fa-times-circle"></i>
                                        Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </form>
</div>
<form action="{{ route('tag_devices')}}" onsubmit="return confirm('Are you sure?');" method="POST"
    role="search">
    @csrf
    <table class="table table-sm table-bordered table-condensed data-tbl table-responsive-sm table-striped table-hover"
        id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th class="text-center d-none">ID</th>
                <th class="text-center">
                    <input type="checkbox" class="check-all-devices" id="check-all-devices" />
                </th>
                <th scope="col" class="text-center text-nowrap">Full Name</th>
                <th scope="col" class="text-center text-nowrap">Email</th>
                <th scope="col" class="text-center text-nowrap">is Active</th>
                <th scope="col" class="text-center text-nowrap">IP Address</th>
                <th scope="col" class="text-center text-nowrap">Platform</th>
                <th scope="col" class="text-center text-nowrap">Device</th>
                <th scope="col" class="text-center text-nowrap">Browser</th>
                <th scope="col" class="text-center text-nowrap">Device Status</th>
            </tr>
        </thead>

        <tbody class="devices">
            
            @foreach($devices as $index => $device)
            <tr>
                <td class="text-center text-body d-none">{{ $device->id }}</td>
                <td class="d-flex justify-content-center ">
                    <div class="mx-auto">
                        <input type="checkbox" name="devices[{{$index}}][checked]"
                            id="device_{{$device->id }}_checked" class="h-100" />
                        <input type="hidden" name="devices[{{$index}}][id]" value="{{$device->id }}"
                            id="device_{{$device->id }}_id" />
                        <input type="hidden" name="devices[{{$index}}][user_id]" value="{{$device->id }}"
                            id="device_{{$device->id }}_user_id" />
                    </div>
                </td>
                <td class="text-body text-wrap">{{ ucfirst($device->user->student->last_name).', '.ucfirst($device->user->student->first_name) }}</td>
                <td class="text-body text-wrap text-center">{{ $device->user->email }}</td>
                <td class="text-center col-md-1">
                    <span
                        class="{{ $device->user->verified?'badge badge-pill badge-success':'badge badge-pill badge-secondary'}}">{{$device->user->verified?'ACTIVE':'INACTIVE'}}</span>
                </td>
                <td class="text-body text-wrap">{{ $device->ip_address }}</td>
                <td class="text-body text-wrap">{{ $device->platform_name.' ver'.$device->platform_version }}</td>
                <td class="text-body text-wrap">{{ $device->device_name.' ver'.$device->device_version }}</td>
                <td class="text-body text-wrap">{{ $device->browser_name.' ver'.$device->browser_version }}</td>
                <td class="text-center col-md-1">
                    <span
                        class="{{ !$device->is_disabled ?'badge badge-pill badge-success':'badge badge-pill badge-secondary'}}">
                        {{ !$device->is_disabled ?'ALLOWED':'DISABLED'}}</span>
                </td>

            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td colspan="2">
                    <select type="text" class="form-control" name="is_disabled">
                        <option value="x">--DEVICE STATUS--</option>
                        <option value="0">ALLOWED</option>
                        <option value="1">DISABLED</option>
                    </select>
                </td>
                <td colspan="7">
                    <button class="btn btn-primary btn-xl text-uppercase " type="submit">SUBMIT</button>
                </td>
            </tr>
        </tfoot>
    </table>
</form>
<div class="d-flex justify-content-center">
    {{ $devices->links() }}
</div>

{{-- @include('admin.students._view-devices') --}}

@endsection

@once
@push('scripts')
<script>
    $("#check-all-devices").on( "click", function(e) {
		current = $(this).prop("checked");
		jQuery(".devices input[type=checkbox]").each(function() {
			$(this).prop("checked", current);
		});
	});

	$("#clearFilter").on("click", function(){
		$("#name").val('');
		$(".form-select-clear option:selected").removeAttr('selected');
		$("#filterBtn").click();
	});


</script>
@endpush
@endonce