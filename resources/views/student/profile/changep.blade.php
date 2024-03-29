@extends('layouts.student')

@section('content')
<div class="container-fluid bg-secondary" style="height: 90vh;min-height: 85vh">

	<div class="row justify-content-center align-content-center h-100">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header text-white bg-dark m-1">

					<i class="fas fa-unlock mx-3"></i>

					Update your password

				</div>
				<div class="card-body">
					<form method="POST" id="contentForm" action="{{ route('student_profile_savep') }}">
						@csrf
						<div class="form-group row pr-lg-5">
							<input id="id" type="hidden" class="form-control @error('id') is-invalid @enderror"
								name="id" value="{{$user->id}}" required autocomplete="id">
							<label for="password"
								class="col-form-label font-weight-bold col-4 text-wrap text-md-right">{{
								__('Password')
								}}</label>
							<input id="password" type="password"
								class="form-control text-dark border border-dark col-8  @error('password') is-invalid @enderror"
								name="password" required autocomplete="new-password">
							@error('password')
							<span class="invalid-feedback text-center" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="form-group row pr-lg-5">
							<label for="password-confirm"
								class="col-form-label font-weight-bold col-4 text-wrap text-md-right">{{
								__('Confirm') }}</label>
							<input id="password-confirm" type="password"
								class="form-control text-dark border border-dark col-8" name="password_confirmation"
								required autocomplete="new-password">
						</div>
						<div class="col-12 mb-2">
							<button class="btn btn-primary btn-xl text-uppercase btn-block" id="sendMessageButton"
								type="submit">Save</button>
						</div>
						<div class="col-12">
							<a class="btn btn-outline-dark float-right btn-block" href="{{ route('student_profile')}}">
								<i class="fas fa-reply"></i> BACK
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	{{-- <section class="page-section" id="services">
		<br />
		<br />
		<br />
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header text-white bg-dark m-1">

						<i class="fas fa-unlock mx-3"></i>

						{{ __('Login') }}

					</div>

					<div class="card-body">
						<form method="POST" action="{{ route('login') }}">
							@csrf

							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address')
									}}</label>

								<div class="col-md-6">
									<input id="email" type="email"
										class="form-control @error('email') is-invalid @enderror" name="email"
										value="{{ old('email') }}" required autocomplete="email" autofocus>

									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password')
									}}</label>

								<div class="col-md-6">
									<input id="password" type="password"
										class="form-control @error('password') is-invalid @enderror" name="password"
										required autocomplete="current-password">

									@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<div class="col-md-6 offset-md-4">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="remember" id="remember" {{
											old('remember') ? 'checked' : '' }}>

										<label class="form-check-label" for="remember">
											{{ __('Remember Me') }}
										</label>
									</div>
								</div>
							</div>

							<div class="form-group row mb-0">
								<div class="col-md-8 offset-md-4">
									<button type="submit" class="btn btn-primary">
										{{ __('Login') }}
									</button>

									@if (Route::has('password.request'))
									<a class="btn btn-link" href="{{ route('password.request') }}">
										{{ __('Forgot Your Password?') }}
									</a>
									@endif
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	{{-- <form method="POST" id="contentForm" action="{{ route('student_profile_savep') }}">
		@csrf
		<div class="col-md-8">
			<div class="form-group row">
				<input id="id" type="hidden" class="form-control @error('id') is-invalid @enderror" name="id"
					value="{{$user->id}}" required autocomplete="id">
				<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

				<div class="col-md-8">
					<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
						name="password" required autocomplete="new-password">

					@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<label for="password-confirm" class="col-md-4 col-form-label text-md-right align-self-center">{{
					__('Confirm') }}</label>

				<div class="col-md-8">
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation"
						required autocomplete="new-password">
				</div>
			</div>
			<hr />

			<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
		</div>

	</form> --}}

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