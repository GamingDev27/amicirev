@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Edit Administrator
	</h1>
	
	<form method="POST" id="contentForm" action="{{ route('admin_user_save') }}" >
		@csrf
		<div class="row align-items-stretch mb-5">
			<div class="col-md-12">
				<div class="form-group">
					<input id="id" type="hidden" name="id" value="{{ $user->id }}" required >
					<input placeholder="Name*" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<input placeholder="Email*" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					
					
					<input id="password" placeholder="PASSWORD*" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					
				</div>
				<div class="form-group">
					<input id="password-confirm" placeholder="CONFIRM PASSWORD*" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
				</div>
				
				<hr />
				<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
			</div>
		</div>
		
	</form>
	
@endsection