@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Seasons</h1>
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Exam Date</th>
				<th>Created Date</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($seasons as $index => $season)
				<tr>
					<td>{{ $season->id }}</td>
					<td>{{ $season->name }}</td>
					<td>{{ $season->description}}</td>
					<td>{{ $season->exam_date_start}}</td>
					<td>{{ $season->created_at}}</td>
					<td>
						<a class="btn btn-outline-primary" href="{{ route('admin_season_edit',$season->id) }}"> <i class="fas fa-pencil-alt"></i> Edit</a> 
						<a class="btn btn-outline-primary" href="{{ route('admin_batch_index',$season->id) }}"> <i class="fas fa-pencil-alt"></i> Batches</a> 
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

