@extends('layouts.admin')

@section('content')
	<h3 class="mt-4">Change Password
		<a class="btn btn-outline-primary float-right" href="{{ route('student_profile')}}"> <i class="fas fa-reply"></i> BACK </a> 
	</h3>
	
	<form method="POST" id="contentForm" action="{{ route('student_profile_savep') }}" >
		@csrf
			<div class="col-md-8">
				<div class="form-group row">
					<input id="id" type="hidden" class="form-control @error('id') is-invalid @enderror" name="id" value="{{$user->id}}" required autocomplete="id">
					<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

					<div class="col-md-8">
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<label for="password-confirm" class="col-md-4 col-form-label text-md-right align-self-center">{{ __('Confirm') }}</label>

					<div class="col-md-8">
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
					</div>
				</div>
				<hr />

				<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
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
			});
		</script>
	@endpush
@endonce

