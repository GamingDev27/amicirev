@extends('layouts.student')

@section('content')
	<h4 class="mt-2">
		Account
	</h4>
	<hr />
	<div class="row">
		<div class="col-12  col-xl-3  col-lg-3 col-md-3" align="center">
			@if($user->student->image)
				<img style="width:90%;" src="/images/{{$user->student->image}}">
			@endif
		</div>	
		<div class="col-12  col-xl-9  col-lg-9 col-md-9">
			<table class="table no-border">
				<tr>
					<td colspan="2">
						<h5>
							{{ strtoupper($user->student->last_name) }},
							{{ strtoupper($user->student->first_name) }}
							{{ strtoupper($user->student->middle_name) }}
						</h5>
					</td>
				</tr>
				<tr>
					<td width="20%"><b>BIRTHDATE:</b></td>
					<td >{{ date('F d, Y',strtotime($user->student->birthdate))}}</td>
				</tr>
				<tr>
					<td><b>GENDER:</b></td>
					<td >{{ $user->student->sex }}</td>
				</tr>
				<tr>
					<td><b>ADDRESS:</b></td>
					<td >
						@if($user->student->address)
							{{ $user->student->address->house_lot }},
							{{ $user->student->address->street }},
							{{ $user->student->address->barangay->name }},
							{{ $user->student->address->city->name }},
							{{ $user->student->address->province->name }}
						@endif
					</td>
				</tr>
				<tr>
					<td><b>EMAIL:</b></td>
					<td >{{ $user->email }}</td>
				</tr>
				<tr>
					<td><b>MOBILE:</b></td>
					<td >{{ $user->student->mobile }}</td>
				</tr>
				<tr>
					<td><b>SCHOOL:</b></td>
					<td >
						@if($user->student->school)
							{{ $user->student->school->name }}
						@endif
					</td>
				</tr>
				<tr>
					<td><b>YEAR GRADUATED:</b></td>
					<td >
						{{ $user->student->year_graduated }}
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<a class="btn btn-outline-primary" href="{{ route('student_profile_edit') }}">
							EDIT ACCOUNT
						</a>
						<a class="btn btn-outline-primary" href="{{ route('student_profile_changep') }}">
							CHANGE PASSWORD
						</a>
					</td>
				</tr>
			</table>
			
		</div>
	</div>
	
@endsection
@once
	@push('scripts')

		<script>
			$(document).ready(function(){
				
			});


			
		</script>

		
	@endpush
@endonce