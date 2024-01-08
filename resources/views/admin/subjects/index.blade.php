@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Subjects
	<a class="btn btn-outline-primary float-right" href="{{ route('admin_subject_add')}}"> <i class="fas fa-plus"></i> ADD</a> 
	</h1>
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Subjects</th>
				<th>Created Date</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($subjects as $index => $subject)
				<tr>
					<td>{{ $subject->id }}</td>
					<td>{{ $subject->name }}</td>
					<td>{{ $subject->description}}</td>
					<td>{{ $subject->exam_date_start}}</td>
					<td>{{ $subject->created_at}}</td>
					<td>
						<a class="btn btn-outline-primary" href="{{ route('admin_subject_edit',$subject->id) }}"> <i class="fas fa-pencil-alt"></i> Edit</a> 
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

