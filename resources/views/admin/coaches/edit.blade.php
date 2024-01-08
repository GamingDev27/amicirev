@extends('layouts.admin')

@section('content')
	<h3 class="mt-4">Edit Coach
		<a class="btn btn-outline-primary float-right" href="{{ route('admin_coaches')}}"> <i class="fas fa-reply"></i> BACK </a> 
	</h3>
	
	<form method="POST" id="contentForm" action="{{ route('admin_coach_save') }}" enctype="multipart/form-data">
		@csrf
		<div class="row align-items-stretch mb-5">
			<div class="col-md-4">
				@if(isset($coach->image) && strlen($coach->image))
					<input type="file" id="imageInput" name="image" >
					<img class="mx-auto rounded-circle" id="imagePreview" alt="Image Preview Here" src="/images/{{$coach->image}}" style="max-width:80%;" />
				@else
					<input type="file" id="imageInput" required name="image" >
					<img class="mx-auto rounded-circle" id="imagePreview" alt="Image Preview Here" style="max-width:80%;display:none;" />
				@endif
				@error('image')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			<div class="col-md-8">
				<div class="form-group">
					
					<select name="salutation"id="salutation" class="form-control @error('salutation') is-invalid @enderror" name="salutation" value="{{ $coach->salutation }}" required autocomplete="salutation" autofocus >
						<option value=""></option>
						<option value="MR" selected="{{ ($coach->salutation == 'MR')?'selected':'' }}">MR</option>
						<option value="MS" selected="{{ ($coach->salutation == 'MS')?'selected':'' }}">MS</option>
						<option value="MRS" selected="{{ ($coach->salutation == 'MRS')?'selected':'' }}">MRS</option>
						<option value="DR" selected="{{ ($coach->salutation == 'DR')?'selected':'' }}">DR</option>
						<option value="PROF" selected="{{ ($coach->salutation == 'PROF')?'selected':'' }}">PROF</option>
						<option value="OFFICER" selected="{{ ($coach->salutation == 'OFFICER')?'selected':'' }}">OFFICER</option>
					</select>
					@error('salutation')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<input id="id" type="hidden" name="id" value="{{ $coach->id }}" />
					<input placeholder="FirstName*" id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $coach->first_name }}" required autocomplete="first_name" autofocus>
					@error('first_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<input placeholder="MiddleName*" id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ $coach->middle_name }}" required autocomplete="middle_name" >
					@error('middle_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<input placeholder="LastName*" id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $coach->last_name }}" required autocomplete="last_name" >
					@error('last_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<input placeholder="PRC LICENSE*" id="license" type="text" class="form-control @error('license') is-invalid @enderror" name="license" value="{{ $coach->license }}" required autocomplete="license" >
					@error('license')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<input placeholder="Title*" id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $coach->title }}" required autocomplete="title" >

					@error('title')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					
				</div>
				<div class="form-check">
					<input type="hidden" name="enabled" value="0" />
					<input class="form-check-input" type="checkbox" name="enabled" id="enabled" value="1" {{ $coach->enabled ? 'checked' : '' }}>

					<label class="form-check-label" for="enabled">
						{{ __('Enabled') }}
					</label>
				</div>
				
				<div class="form-group mb-md-0">
					
					<div class="form-group form-group-textarea mb-md-0">
						<textarea class="form-control @error('accomplishments') is-invalid @enderror" id="accomplishments" name="accomplishments" placeholder="Accomplishments *" >{{ $coach->accomplishments }}</textarea>
					</div>
					@error('accomplishments')
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

@once
    @push('scripts')

		<script>
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
				
					reader.onload = function(e) {
						jQuery('#imagePreview').attr('src', e.target.result);
						jQuery('#imagePreview').show();
					}
				
					reader.readAsDataURL(input.files[0]); 
				}
			}
			jQuery(document).ready(function(){
				jQuery("#imageInput").change(function() {
					readURL(this);
				});
				ClassicEditor
					.create( document.querySelector( '#accomplishments' ), {
						// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
					} )
					.then( editor => {
						editor.ui.view.editable.element.style.height = '300px';
						window.editor = editor;
					} )
					.catch( err => {
						console.error( err.stack );
					} );
			});
		</script>
	@endpush
@endonce

