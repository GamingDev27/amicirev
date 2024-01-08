@extends('layouts.admin')

@section('content')
	<div class="mt-4 mb-1">
		<form action="{{ route('admin_student_search')}}" method="POST" role="search">
			@csrf
			<div class="form-row ">
				<div class="col-2">
					<h4 class="">Search Students</h4>
				</div>
				<div class="col-2">
					<input type="text" class="form-control" name="first_name" placeholder="FirstName">
				</div>
				<div class="col-2">
					<input type="text" class="form-control" name="last_name" placeholder="LastName">
				</div>
				<div class="col-2">
					<select type="text" class="form-control" name="email" >
						<option value="" ><em>EMAIL</em></option>
						<option value="1">VERIFIED</option>
						<option value="2">NOT YET</option>
					</select>
				</div>
				<div class="col-2">
					<select type="text" class="form-control" name="manual" >
						<option value="" ><em>MANUAL</em></option>
						<option value="1">VERIFIED</option>
						<option value="2">NOT YET</option>
					</select>
				</div>
				<div class="col-2">
					<button class="btn btn-outline-primary float-right" type="submit"> <i class="fas fa-magnify"></i> SEARCH</button> 
				</div>
			</div>
		</form>
	</div>
	<form action="{{ route('admin_student_search')}}" onsubmit="return confirm('Are you sure?');" method="POST" role="search">
		@csrf
		<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>ID</th>
					<th></th>
					<th>FirstName</th>
					<th>LastName</th>
					<th>BirthDate</th>
					<th>Sex</th>
					<th>Email</th>
					<th>Registered</th>
					<th>Email Verification</th>
					<th>Manual Verification</th>
				</tr>
			</thead>
			
			<tbody>
				@foreach($students as $index => $student)
					<tr>
						<td>{{ $student->id }}</td>
						<td>
							<input type="checkbox" name="students[{{$index}}][checked]" id="student_{{$student->id }}_checked" />
							<input type="hidden" name="students[{{$index}}][id]" value="{{$student->id }}" id="student_{{$student->id }}_id" />
							<input type="hidden" name="students[{{$index}}][user_id]" value="{{$student->user->id }}" id="student_{{$student->id }}_user_id" />
						</td>
						<td>{{ $student->first_name }}</td>
						<td>{{ $student->last_name}}</td>
						<td>{{ $student->birthdate}}</td>
						<td>{{ $student->sex}}</td>
						<td>{{ $student->user->email}}</td>
						<td>{{ $student->user->created_at}}</td>
						<td>{{ strlen($student->user->email_verified_at)?'VERIFIED':'NOT YET'}}</td>
						<td>{{ $student->user->verified?'VERIFIED':'NOT YET'}}</td>
						
					</tr>
				@endforeach
			</tbody>
			<tfoot>	
				<tr>
					<td></td>
					<td colspan="2"> 
						<select type="text" class="form-control" name="manual_verify" >
							<option value="0"></option>
							<option value="1">VERIFY</option>
							<option value="2">UNVERIFY</option>
						</select>
					</td>
					<td colspan="7">
						<button class="btn btn-primary btn-xl text-uppercase" type="submit">SUBMIT</button>
					</td>
				</tr>
			</tfoot>
		</table>
	</form>
	{{ $students->links() }}
@endsection

