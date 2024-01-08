@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Edit Team Member
		<a class="btn btn-outline-primary float-right" href="{{ route('admin_team')}}"> <i class="fas fa-reply"></i> BACK </a> 
	</h1>
	
	<form method="POST" id="contentForm" action="{{ route('admin_save_content') }}" enctype="multipart/form-data">
		@csrf
		<div class="row align-items-stretch mb-5">
			<div class="col-md-4" >
				@if(isset($content->image) && strlen($content->image))
					<input type="file" id="imageInput" name="image" >
					<img class="mx-auto rounded-circle" id="imagePreview" alt="Image Preview Here" src="/images/{{$content->image}}" style="max-width:80%;" />
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
					<input placeholder="Name*" id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $content->title }}" required autocomplete="title" autofocus>
					@error('title')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<input id="id" type="hidden"  name="id" value="{{ $content->id }}"  >
					<input id="type" type="hidden"  name="type" value="{{ $type }}"  >
					<input id="redirectTo" type="hidden"  name="redirectTo" value="admin_team" />
					<input placeholder="Title*" id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $content->description }}" required autocomplete="description" >

					@error('description')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					
				</div>
				<div class="form-group mb-md-0">
					
					<div class="form-group form-group-textarea mb-md-0">
						<textarea class="form-control @error('details') is-invalid @enderror" id="details" name="details" placeholder="Description *" required autocomplete="details">{{ $content->details }}</textarea>
						<p class="help-block text-danger"></p>
					</div>
					@error('details')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-check">
					<input type="hidden" name="enabled" value="0" />
					<input class="form-check-input" type="checkbox" name="enabled" id="enabled" value="1" {{ $content->enabled ? 'checked' : '' }}>

					<label class="form-check-label" for="enabled">
						{{ __('Enabled') }}
					</label>
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
						//console.log(e.target.filesize);
						//console.log(e.target);
					}
				
					reader.readAsDataURL(input.files[0]); 
				}
			}
			jQuery(document).ready(function(){
				console.log('here is thes');
				jQuery("#imageInput").change(function() {
					console.log('here is this');
					readURL(this);
				});
			});
		</script>
	@endpush
@endonce

