@extends('layouts.admin')

@section('content')
<div class="mt-4 mb-4">
	<form action="{{ route('admin_batch_student',$batch->id)}}" method="POST" role="search">
		@csrf
		<div class="form-row gy-2">
			<div class="col-12 mb-4 pb-3">
				<h4 class="col-12 col-lg-10 d-inline">Manage Students for {{ $batch->season->name }} - {{
					$batch->name }}

				</h4>
				<a class="col-12 col-lg-2 btn btn-outline-dark float-right"
					href="{{ route('admin_batch_view',$batch->id)}}"> <i class="fas fa-reply"></i> BACK
				</a>
			</div>
			<hr />
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
								<div class="input-group col-12 col-md-6 col-lg-4 mb-1">
									<input type="text" class="form-control" name="search[first_name]"
										placeholder="FirstName" id="first_name"
										value="{{ isset($search['first_name'])?$search['first_name']:'' }}" />
								</div>
								<div class="input-group col-12 col-md-6 col-lg-4 mb-1">
									<input type="text" class="form-control" name="search[last_name]"
										placeholder="LastName" id="last_name"
										value="{{ isset($search['last_name'])?$search['last_name']:'' }}" />
								</div>
								<div class="col-12 col-md-6 col-lg-4 mb-1">
									<select type="text" class="form-control form-select-clear" name="search[verified]"
										value="{{ isset($search['verified'])?$search['verified']:'' }}">
										<option value=""><em>ENROLLMENT STATUS</em></option>
										<option value="1" {{ request('search.verified')=='1' ? 'selected' : '' }}>
											ENROLLED
										</option>
										<option value="0" {{ request('search.verified')=='0' ? 'selected' : '' }}>NOT
											YET
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

<form action="{{ route('admin_batch_student',$batch->id)}}" onsubmit="return confirm('Are you sure?');" method="POST">
	@csrf
	<table class="table table-xl table-bordered table-condensed data-tbl table-responsive table-striped table-hover"
		id="dataTable" width="100%" cellspacing="0">
		<thead class="thead-dark">
			<tr>
				<th class="text-center">ID</th>
				<th class="text-center">
					<input type="checkbox" class="check-all-students" id="check-all-students" />
				</th>
				<th scope="col" class="text-center text-nowrap">Status</th>
				<th scope="col" class="text-center text-nowrap">Amount Paid</th>
				<th scope="col" class="text-center text-nowrap">Payment Type</th>
				<th scope="col" class="text-center text-nowrap">Outcome</th>
				<th scope="col" class="text-center text-nowrap">Name</th>
				<th scope="col" class="text-center text-nowrap">Birthdate</th>
				<th scope="col" class="text-center text-nowrap">Gender</th>
				<th scope="col" class="text-center text-nowrap">Email</th>
				<th scope="col" class="text-center text-nowrap">Mobile</th>
				<th scope="col" class="text-center text-nowrap">Date Enrolled</th>
			</tr>
		</thead>

		<tbody class="enrollees">
			@if(isset($enrolledstudents))
			@foreach($enrolledstudents as $index => $enrollment)
			<tr>
				<td class="text-center text-body">{{ $enrollment->id }}</td>
				<td class="d-flex justify-content-center">
					<input type="checkbox" name="enrollments[{{$index}}][checked]"
						id="enrollment_{{$enrollment->id }}_checked" />
					<input type="hidden" name="enrollments[{{$index}}][id]" value="{{$enrollment->id }}"
						id="enrollment_{{$enrollment->id }}_id" />
				</td>
				<td>
					<div class="form-group">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" {{ ($enrollment->verified ==
							1)?'checked="checked"':'' }} required name="enrollments[{{$index}}][verified]"
							id="verified{{$index}}_1" value="1">
							<label class="form-check-label" for="verified{{$index}}_1"> VERIFY </label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" {{ ($enrollment->verified ==
							0)?'checked="checked"':'' }} required name="enrollments[{{$index}}][verified]"
							id="verified{{$index}}_0" value="0">
							<label class="form-check-label" for="verified{{$index}}_0"> NOTYET </label>
						</div>
						@error('sex')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror

					</div>
				</td>
				<td>
					<input type="number" class="form-control p-0" name="enrollments[{{$index}}][amount_paid]"
						value="{{ $enrollment->amount_paid }}" id="enrollment_{{$enrollment->amount_paid }}" />
				</td>
				<td>
					<select class="form-control" name="enrollments[{{$index}}][payment_status]">
						@foreach($paymentstatuses as $paymentstatusid => $paymentstatus)
						<option value="{{$paymentstatusid}}" {{ ($enrollment->payment_status ==
							$paymentstatusid)?'selected="selected"':'' }}>{{ $paymentstatus }}</option>
						@endforeach
					</select>
				</td>
				<td>
					<select class="form-control" name="enrollments[{{$index}}][passed]">
						<option value=""></option>
						<option value="1" {{ ($enrollment->passed === 1)?'selected="selected"':'' }}>PASSED</option>
						<option value="0" {{ ($enrollment->passed === 0)?'selected="selected"':'' }}>FAILED</option>
					</select>
				</td>
				<td class="text-body text-wrap">
					{{ $enrollment->student->last_name }},
					{{ $enrollment->student->first_name }}
					{{ $enrollment->student->middle_name }}
				</td>
				<td class="text-body text-wrap">{{ $enrollment->student->birthdate}}</td>
				<td class="text-body text-wrap">{{ $enrollment->student->sex}}</td>
				<td class="text-body text-wrap">{{ $enrollment->student->user->email}}</td>
				<td class="text-body text-wrap">{{ $enrollment->student->mobile}}</td>
				<td class="text-body text-wrap">{{ date('m/d/Y H:i',strtotime($enrollment->created_at))}}</td>

			</tr>
			@endforeach
			@endif
		</tbody>

		<tfoot>
			<tr>
				<td></td>
				<td colspan="11">
					<button class="btn btn-primary btn-xl text-uppercase" type="submit">SUBMIT</button>
				</td>
			</tr>
		</tfoot>
	</table>

</form>

<div class="d-flex justify-content-center">
	{{ $enrolledstudents->links() }}
</div>
@endsection
{{-- <table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
	<thead>
		<tr>
			<th>ID</th>
			<th>
				<input type="checkbox" id="checkAllBelow()" />
			</th>
			<th width="100px">VERIFY</th>
			<th width="100px">PAID AMOUNT</th>
			<th width="150px">PAYMENT</th>
			<th width="100px">OUTCOME</th>
			<th>NAME</th>
			<th>BirthDate</th>
			<th>Sex</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Date Enrolled</th>
		</tr>
	</thead>

	<tbody>
		@if(isset($enrolledstudents))
		@foreach($enrolledstudents as $index => $enrollment)
		<tr>
			<td>{{ $enrollment->id }}</td>
			<td>
				<input type="checkbox" name="enrollments[{{$index}}][checked]"
					id="enrollment_{{$enrollment->id }}_checked" />
				<input type="hidden" name="enrollments[{{$index}}][id]" value="{{$enrollment->id }}"
					id="enrollment_{{$enrollment->id }}_id" />
			</td>
			<td>
				<div class="form-group">

					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" {{ ($enrollment->verified ==
						1)?'checked="checked"':'' }} required name="enrollments[{{$index}}][verified]"
						id="verified{{$index}}_1" value="1">
						<label class="form-check-label" for="verified{{$index}}_1"> VERIFY </label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" {{ ($enrollment->verified ==
						0)?'checked="checked"':'' }} required name="enrollments[{{$index}}][verified]"
						id="verified{{$index}}_0" value="0">
						<label class="form-check-label" for="verified{{$index}}_0"> NOTYET </label>
					</div>
					@error('sex')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror

				</div>
			</td>
			<td>
				<input type="number" class="form-control p-0" name="enrollments[{{$index}}][amount_paid]"
					value="{{ $enrollment->amount_paid }}" id="enrollment_{{$enrollment->amount_paid }}" />
			</td>
			<td>
				<select class="form-control" name="enrollments[{{$index}}][payment_status]">
					@foreach($paymentstatuses as $paymentstatusid => $paymentstatus)
					<option value="{{$paymentstatusid}}" {{ ($enrollment->payment_status ==
						$paymentstatusid)?'selected="selected"':'' }}>{{ $paymentstatus }}</option>
					@endforeach
				</select>
			</td>
			<td>
				<select class="form-control" name="enrollments[{{$index}}][passed]">
					<option value=""></option>
					<option value="1" {{ ($enrollment->passed === 1)?'selected="selected"':'' }}>PASSED</option>
					<option value="0" {{ ($enrollment->passed === 0)?'selected="selected"':'' }}>FAILED</option>
				</select>
			</td>
			<td>
				{{ $enrollment->student->last_name }},
				{{ $enrollment->student->first_name }}
				{{ $enrollment->student->middle_name }}
			</td>
			<td>{{ $enrollment->student->birthdate}}</td>
			<td>{{ $enrollment->student->sex}}</td>
			<td>{{ $enrollment->student->user->email}}</td>
			<td>{{ $enrollment->student->mobile}}</td>
			<td>{{ date('m/d/Y H:i',strtotime($enrollment->created_at))}}</td>

		</tr>
		@endforeach
		@endif
	</tbody>
	<tfoot>
		<tr>
			<td colspan="11">
				<button class="btn btn-primary btn-xl text-uppercase" type="submit">SUBMIT</button>
			</td>
		</tr>
	</tfoot>
</table> --}}
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
			
</script>
@endpush
@endonce