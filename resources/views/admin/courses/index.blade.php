@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Courses
	<a class="btn btn-outline-primary float-right" href="{{ route('admin_course_add')}}"> <i class="fas fa-plus"></i> ADD</a> 
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
			@foreach($courses as $index => $course)
				<tr>
					<td>{{ $course->id }}</td>
					<td>{{ $course->code }} - {{ $course->name }}</td>
					<td>{{ $course->description}}</td>
					<td width="25%">
						<ul>
							@foreach($course->subjects as $subject)
								<li>{{ Str::limit($subject->name,20) }} <a class="btn btn-outline-primary m-0 p-0 px-1" href="{{ route('admin_subject_edit',$subject->id) }}"> <i class="fas fa-pencil-alt"></i> Edit</a> </li>
							@endforeach
						</ul>
					</td>
					<td>{{ $course->created_at}}</td>
					<td>
						<a class="btn btn-outline-primary m-0 p-0 px-1" href="{{ route('admin_course_edit',$course->id) }}"> <i class="fas fa-pencil-alt"></i> Edit</a> 
						<a class="btn btn-outline-primary m-0 p-0 px-1" href="{{ route('admin_subject_add',$course->id) }}"> <i class="fas fa-pencil-alt"></i> Add Subject</a> 
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

