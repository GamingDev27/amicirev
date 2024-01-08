@extends('layouts.admin')

@section('content')

	<div class="mt-4 mb-1">
		<!--<form action="{{ route('admin_student_search')}}" method="POST" role="search">-->
		<form action="{{ route('admin_batch_student',$batch->id)}}" method="POST" role="search">
			@csrf
			<div class="form-row ">
				<div class="col-2">
					<h4 class=""> Manage Students </h4>
				</div>
				<div class="col-2">
					<input type="text" class="form-control" name="search[first_name]" placeholder="FirstName" value="{{ isset($search['first_name'])?$search['first_name']:'' }}"/>
				</div>
				<div class="col-2">
					<input type="text" class="form-control" name="search[last_name]" placeholder="LastName" value="{{ isset($search['last_name'])?$search['last_name']:'' }}"/>
				</div>
				<div class="col-2">
					<select type="text" class="form-control" name="search[verified]"  value="{{ isset($search['verified'])?$search['verified']:'' }}">
						<option value=""></option>
						<option value="1">VERIFIED</option>
						<option value="0">NOT YET</option>
					</select>
				</div>
				<div class="col-2">
					<button class="btn btn-outline-primary" type="submit"> <i class="fas fa-magnify"></i> SEARCH</button> 
				</div>
				
			</div>
		</form>
	</div>
	<form action="{{ route('admin_batch_student',$batch->id)}}" onsubmit="return confirm('Are you sure?');" method="POST" >
		@csrf
		<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
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
								<input type="checkbox" name="enrollments[{{$index}}][checked]" id="enrollment_{{$enrollment->id }}_checked" />
								<input type="hidden" name="enrollments[{{$index}}][id]" value="{{$enrollment->id }}" id="enrollment_{{$enrollment->id }}_id" />
							</td>
							<td>
								<div class="form-group">
										
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" {{ ($enrollment->verified == 1)?'checked="checked"':'' }} required name="enrollments[{{$index}}][verified]" id="verified{{$index}}_1" value="1">
										<label class="form-check-label" for="verified{{$index}}_1"> VERIFY </label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" {{ ($enrollment->verified == 0)?'checked="checked"':'' }} required name="enrollments[{{$index}}][verified]" id="verified{{$index}}_0" value="0">
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
								<input type="number" class="form-control p-0"name="enrollments[{{$index}}][amount_paid]" value="{{ $enrollment->amount_paid }}" id="enrollment_{{$enrollment->amount_paid }}" />
							</td>
							<td>
								<select class="form-control" name="enrollments[{{$index}}][payment_status]" >
									@foreach($paymentstatuses as $paymentstatusid => $paymentstatus)
										<option value="{{$paymentstatusid}}" {{ ($enrollment->payment_status == $paymentstatusid)?'selected="selected"':'' }}>{{ $paymentstatus }}</option>
									@endforeach
								</select>
							</td>
							<td>
								<select class="form-control" name="enrollments[{{$index}}][passed]" >
									<option value="" ></option>
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
		</table>
	</form>
	<br />
	{{ $enrolledstudents->links() }}
@endsection

@once
    @push('scripts')

		<script>
			function checkAll(input) {
				current = jQuery(input).prop("checked");
				console.log('checked');
				console.log(current);
				jQuery(".courses_subjects input[type=checkbox]").each(function() {
					jQuery(this).prop("checked", current);
				});
			}
			
		</script>
	@endpush
@endonce