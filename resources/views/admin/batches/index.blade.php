@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Batchs</h1>
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Enabled</th>
				<th>Created Date</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($batchs as $index => $batch)
				<tr>
					<td>{{ $batch->id }}</td>
					<td>{{ $batch->name }}</td>
					<td>{{ $batch->description}}</td>
					<td>{{ $batch->enabled?'YES':'NO'}}</td>
					<td>{{ $batch->created_at}}</td>
					<td>
						<a class="btn btn-outline-primary" href="{{ route('admin_batch_edit',$batch->id) }}"> <i class="fas fa-pencil-alt"></i> Edit</a> 
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

