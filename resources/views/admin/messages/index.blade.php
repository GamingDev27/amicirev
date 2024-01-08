@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Messages</h1>
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>No</th>
				<th>Date</th>
				<th>Name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Message</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($messages as $index => $message)
				<tr>
					<td>{{ $message->id }}</td>
					<td>{{ $message->created_at }}</td>
					<td>{{ $message->name}}</td>
					<td>{{ $message->email}}</td>
					<td>{{ $message->phone}}</td>
					<td>{!! $message->message !!}</td>
					<td>
						<button class="btn btn-outline-primary" onclick="window.location.href = 'mailto: {{$message->email}}'"> <i class="fas fa-reply"></i> Reply</button> 
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $messages->links() }}
@endsection

