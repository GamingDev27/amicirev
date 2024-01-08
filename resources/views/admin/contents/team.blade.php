@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Team Members
		<a class="btn btn-outline-primary float-right" href="{{ route('admin_team_add')}}"> <i class="fas fa-plus"></i> ADD</a> 
	</h1>
	
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>No</th>
				<th>Picture</th>
				<th>Name</th>
				<th>Title</th>
				<th>Description</th>
				<th>Status</th>
				<th>Date Added</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($members as $index => $member )
				<tr>
					<td>{{ $member->id }}</td>
					<td>
						<img class="mx-auto rounded-circle" src="/images/{{ $member->image}}" style="max-width:150px;" />
					</td>
					<td>{{ $member->title}}</td>
					<td>{{ $member->description}}</td>
					<td>{!! $member->details !!}</td>
					<td>{{ $member->enabled ? 'enabled':'disabled'}}</td>
					<td>{{ $member->created_at }}</td>
					<td>
						<a class="btn btn-outline-primary" href="{{route('admin_team_edit',$member->id)}}"> <i class="fas fa-pencil"></i> Edit</button> 
					
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
@endsection

