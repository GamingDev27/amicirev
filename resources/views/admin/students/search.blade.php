@extends('layouts.admin')

@section('content')
<div class="mt-4 mb-4">
	<form action="{{ route('admin_student_search')}}" method="POST" role="search">
		@csrf
		<div class="form-row gy-2">
			<div class="col-12">
				<h4 class="border-bottom pb-3 mb-4">Search Students</h4>
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
									<input type="text" class="form-control" name="first_name" id="first_name"
										placeholder="FirstName" value="{{
										request('first_name') }}" autocomplete="first_name">
								</div>
								<div class="input-group col-12 col-md-6 col-lg-3 mb-1">
									<input type="text" class="form-control" name="last_name" id="last_name"
										placeholder="LastName" value="{{
										request('last_name') }}" autocomplete="last_name">
									{{-- <div class="input-group-append">
										<button class="btn btn-outline-primary" type="submit" id="search-lastname"><i
												class="fas fa-search"></i></button>
									</div> --}}
								</div>
								<div class="col-12 col-md-6 col-lg-3 mb-1">
									<select type="text" class="form-control form-select-clear" name="email">
										<option value=""><em>EMAIL</em></option>
										<option value="1" {{ request('email')=='1' ? 'selected' : '' }}>VERIFIED
										</option>
										<option value="2" {{ request('email')=='2' ? 'selected' : '' }}>NOT YET</option>
									</select>
								</div>
								<div class="col-12 col-md-6 col-lg-3 mb-1">
									<select type="text" class="form-control form-select-clear" name="manual">
										<option value=""><em>MANUAL</em></option>
										<option value="1" {{ request('manual')=='1' ? 'selected' : '' }}>VERIFIED
										</option>
										<option value="2" {{ request('manual')=='2' ? 'selected' : '' }}>NOT YET
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
<form action="{{ route('admin_student_search')}}" onsubmit="return confirm('Are you sure?');" method="POST"
	role="search">
	@csrf
	<table class="table table-sm table-bordered table-condensed data-tbl table-responsive table-striped table-hover"
		id="dataTable" width="100%" cellspacing="0">
		<thead class="thead-dark">
			<tr>
				<th class="text-center">ID</th>
				<th class="text-center">
					<input type="checkbox" class="check-all-students" id="check-all-students" />
				</th>
				<th scope="col" class="text-center text-nowrap">First Name</th>
				<th scope="col" class="text-center text-nowrap">Last Name</th>
				<th scope="col" class="text-center text-nowrap">Birth Date</th>
				<th scope="col" class="text-center text-nowrap">Sex</th>
				<th scope="col" class="text-center text-nowrap">Email</th>
				<th scope="col" class="text-center text-nowrap">Registered</th>
				<th scope="col" class="text-center text-nowrap">Email Verification</th>
				<th scope="col" class="text-center text-nowrap">Manual Verification</th>
				<th scope="col" class="text-center text-nowrap">Devices</th>
			</tr>
		</thead>

		<tbody class="enrollees">
			@foreach($students as $index => $student)
			<tr>
				<td class="text-center text-body">{{ $student->id }}</td>
				<td class="d-flex justify-content-center ">
					<div class="mx-auto">
						<input type="checkbox" name="students[{{$index}}][checked]"
							id="student_{{$student->id }}_checked" class="h-100" />
						<input type="hidden" name="students[{{$index}}][id]" value="{{$student->id }}"
							id="student_{{$student->id }}_id" />
						<input type="hidden" name="students[{{$index}}][user_id]" value="{{$student->user->id }}"
							id="student_{{$student->id }}_user_id" />
					</div>
				</td>
				<td class="text-body text-wrap">{{ $student->first_name }}</td>
				<td class="text-body text-wrap">{{ $student->last_name}}</td>
				<td class="text-body text-wrap">{{ $student->birthdate}}</td>
				<td class="text-body text-wrap">{{ $student->sex}}</td>
				<td class="text-body text-wrap">{{ $student->user->email}}</td>
				<td class="text-body text-wrap">{{ $student->user->created_at}}</td>
				<td class="text-center col-md-1">
					<span
						class="{{ $student->user->email_verified_at?'badge badge-pill badge-success':'badge badge-pill badge-secondary'}}">{{
						strlen($student->user->email_verified_at)?'VERIFIED':'NOT YET'}}</span>
				</td>
				<td class="text-center col-md-1">
					<span
						class="{{ $student->user->verified?'badge badge-pill badge-success':'badge badge-pill badge-secondary'}}">{{$student->user->verified?'VERIFIED':'NOT
						YET'}}</span>
				</td>
				<td class="text-body text-center text-wrap">
					<a href="#" class="badge badge-primary view-modal-btn" data-id="{{ $student->user->id }}" >VIEW DEVICES</a>
					{{-- <a href="{{ route('view_user_devices', [$student->user->id]) }}" class="badge badge-primary view-modal-btn" data-toggle="modal" data-target="#viewDevicesModal">VIEW DEVICES</a> --}}
					{{-- <a href="{{ route('view_user_devices', [$student->user->id]) }}" class="badge badge-primary view-modal-btn" >VIEW DEVICES</a> --}}
				</td>

			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td></td>
				<td colspan="2">
					<select type="text" class="form-control" name="manual_verify">
						<option value="0"></option>
						<option value="1">VERIFY</option>
						<option value="2">UNVERIFY</option>
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
	{{ $students->links() }}
</div>

@include('admin.students._view-devices')

@endsection

@once
@push('scripts')
<script>
	$("#check-all-students").on( "click", function(e) {
		current = $(this).prop("checked");
		jQuery(".enrollees input[type=checkbox]").each(function() {
			$(this).prop("checked", current);
		});
	});

	$("#clearFilter").on("click", function(){
		$("#first_name").val('');
		$("#last_name").val('');
		$(".form-select-clear option:selected").removeAttr('selected');
		$("#filterBtn").click();
	});
	
	$(".view-modal-btn").click(function() {
		const id = $(this).data('id');
		$.ajax({
            url: '/admin/students/search/devices/user/' + id,
			type: 'GET',
			headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        	},
            success: function(data) {
				$('#modal-user-id').val(id);
				$('#modalTableRow').html(data);
				$('#viewDevicesModal').modal('show');
			},
		});
	});
</script>
@endpush
@endonce