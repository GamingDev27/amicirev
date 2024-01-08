@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Edit Season
	</h1>
	
	<form method="POST" id="contentForm" action="{{ route('admin_season_save') }}" >
		@csrf
		<div class="row align-items-stretch mb-5">
			<div class="col-md-12">
				<div class="form-group">
					<input id="id" type="hidden" name="id" value="{{ $season->id }}" required >
					<input placeholder="Name*" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $season->name }}" required autocomplete="name" autofocus>
					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group mb-md-0">
					
					<div class="form-group form-group-textarea mb-md-0">
						<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description *" required autocomplete="description">{{ $season->description }}</textarea>
						<p class="help-block text-danger"></p>
					</div>
					@error('description')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<input placeholder="ExamDate*" id="exam_date" type="date" class="form-control @error('exam_date') is-invalid @enderror" name="exam_date" required value="{{ $season->exam_start_date }}" autocomplete="exam_date" >
					@error('exam_date')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<hr />
				<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
			</div>
		</div>
		
	</form>
	
@endsection