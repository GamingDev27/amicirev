@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Edit Batch
	</h1>
	
	<form method="POST" id="contentForm" action="{{ route('admin_batch_save') }}" >
		@csrf
		<div class="row align-items-stretch mb-5">
			<div class="col-md-6">
				<div class="form-group">
					<input id="id" type="hidden" name="id" value="{{ $batch->id }}" required >
					<input id="season_id" type="hidden" name="season_id" value="{{ $batch->season_id }}" required >
					<input placeholder="Name*" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $batch->name }}" required autocomplete="name" autofocus>
					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group mb-md-0">
					
					<div class="form-group form-group-textarea mb-md-0">
						<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description *" required autocomplete="description">{{ $batch->description }}</textarea>
						<p class="help-block text-danger"></p>
					</div>
					@error('description')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<input placeholder="Slot*" id="maximum" type="number" class="form-control @error('maximum') is-invalid @enderror" name="maximum" value="{{ $batch->maximum }}" required autocomplete="maximum">
					@error('maximum')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<input placeholder="Sections*" id="sections" type="number" class="form-control @error('sections') is-invalid @enderror" name="sections"  value="{{ $batch->sections }}" required autocomplete="sections">
					@error('sections')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<input placeholder="Registration Start Date*" id="date_start" type="date" class="form-control @error('date_start') is-invalid @enderror" name="date_start"  value="{{ $batch->date_start }}" required autocomplete="date_start" >
					@error('date_start')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				
				<div class="form-group">
					<input placeholder="Registration End Date*" id="date_end" type="date" class="form-control @error('date_end') is-invalid @enderror" name="date_end"  value="{{ $batch->date_end }}" required autocomplete="date_end" >
					@error('date_end')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-check">
					<input type="hidden" name="enabled" value="0" />
					<input class="form-check-input" type="checkbox" name="enabled" id="enabled" value="1" {{ $batch->enabled ? 'checked' : '' }}>

					<label class="form-check-label" for="enabled">
						{{ __('Enabled') }}
					</label>
				</div>
				
				<hr />
				<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
			</div>
			<div class="col-md-6 courses_subjects">
				<ul class="list-group list-group-flush">
					@foreach($courses as $index => $course)
						@php
							$hassubj = false;
						@endphp
						@foreach($course->subjects as $index2 => $subject)
							@if(!isset($classes[$course->id][$subject->id]))
								@php
									$hassubj = true;
									break;
								@endphp
							@endif
						@endforeach
						@if($hassubj)
							<li class="list-group-item">
								<input type="checkbox" name="courses[{{$index}}][checked]" id="course_{{$course->id }}_checked" />
								<input type="hidden" name="courses[{{$index}}][id]" value="{{$course->id }}" id="course_{{$course->id }}_id" />
								<label for="course_{{$course->id }}_checked" > <b>{{ $course->name }}</b> </label>
								<br />
								@foreach($course->subjects as $index2 => $subject)
									@if(!isset($classes[$course->id][$subject->id]))
										<span class="badge badge-light" style="font-weight:normal;">
											<input type="checkbox" name="courses[{{$index}}][subjects][{{$index2}}][checked]" id="course_{{$course->id }}_subject_{{$subject->id }}_checked" />
											<input type="hidden" name="courses[{{$index}}][subjects][{{$index2}}][id]" value="{{$subject->id }}" id="course_{{$course->id }}_subject_{{$subject->id }}_id" />
											<label for="course_{{$course->id }}_subject_{{$subject->id }}_checked" > {{ $subject->name }}({{ $subject->code }}) </label>
										</span>
									@endif
								@endforeach
							</li>	
						@endif
					@endforeach
				</ul>
			</div>
		</div>
		
	</form>
	
@endsection