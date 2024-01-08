@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Edit Course
	</h1>
	
	<form method="POST" id="contentForm" action="{{ route('admin_course_save') }}" >
		@csrf
		<div class="row align-items-stretch mb-5">
			<div class="col-md-12">
			<div class="form-group">
					<input id="id" type="hidden" name="id" value="{{ $course->id }}" required >
					<input placeholder="Name*" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $course->name }}" required autocomplete="name" autofocus>
					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<input id="id" type="hidden" name="id" value="{{ $course->id }}" required >
					<input placeholder="Code*" id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $course->code }}" required autocomplete="code" autofocus>
					@error('code')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-check">
					<input type="hidden" name="enabled" value="0" />
					<input class="form-check-input" type="checkbox" name="enabled" id="enabled" value="1" {{ $course->enabled ? 'checked' : '' }}>

					<label class="form-check-label" for="enabled">
						{{ __('Enabled') }}
					</label>
				</div>
				<div class="form-group mb-md-0">
					
					<div class="form-group form-group-textarea mb-md-0">
						<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description *" required autocomplete="description">{{ $course->description }}</textarea>
						<p class="help-block text-danger"></p>
					</div>
					@error('description')
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