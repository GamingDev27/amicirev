@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Courses
	<a class="btn btn-outline-primary float-right" href="{{ route('admin_user_add')}}"> <i class="fas fa-plus"></i> ADD</a> 
	</h1>
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Enabled</th>
				<th>Created Date</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($users as $index => $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email}}</td>
					<td>
						{{ $user->verified ? 'YES':'NO' }}
					</td>
					<td>{{ $user->created_at}}</td>
					<td>
						<a class="btn btn-outline-primary m-0 p-0 px-1" href="{{ route('admin_user_edit',$user->id) }}"> <i class="fas fa-pencil-alt"></i> Edit</a> 
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

