@extends('layouts.admin')

@section('content')
	<h3 class="mt-4">Coaches
		<a class="btn btn-outline-primary float-right" href="{{ route('admin_coach_add')}}"> <i class="fas fa-plus"></i> ADD</a> 
	</h3>
	
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>ID</th>
				<th>Picture</th>
				<th>Name</th>
				<th>Title</th>
				<th>PRC License</th>
				<th>Accomplishments</th>
				<th>Status</th>
				<th>Date Added</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($coachs as $index => $coach )
				<tr>
					<td>{{ $coach->id }}</td>
					<td>
						<img class="mx-auto rounded-circle" src="/images/{{ $coach->image}}" style="max-width:150px;" />
					</td>
					<td> {{ $coach->salutation }} {{ $coach->first_name }} {{ $coach->middle_name }} {{ $coach->last_name }}</td>
					<td>{{ $coach->title}}</td>
					<td>{{ $coach->license}}</td>
					<td>{!! $coach->accomplishments !!}</td>
					<td>{{ $coach->enabled ? 'enabled':'disabled'}}</td>
					<td>{{ $coach->created_at }}</td>
					<td>
						<a class="btn btn-outline-primary" href="{{route('admin_coach_edit',$coach->id)}}"> <i class="fas fa-pencil"></i> Edit</button> 
					
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
@endsection

