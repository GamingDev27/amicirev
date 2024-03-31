@extends('layouts.student')

@section('content')
<div class="container-fluid bg-secondary h-100 w-100 mh-100" style="height: 100vh;min-height: 100vh">
	<h4 class="pt-4 text-light">
		Account Profile
	</h4>
	<hr class="bg-dark" />
	<div class="row mb-4">
		<div class="col-12  col-md-3" align="center">
			<img style="width:90%;"
				src="{{ ($user->student->image != null ? '/images/'.$user->student->image : '/images/user.png') }}"
				alt="Profile Image" class="text-light">
			<div class="row mt-5 gx-2">
				<div class="my-2 col-12 col-lg-6">
					<a class="btn btn-warning btn-block" href="{{ route('student_profile_edit') }}">
						EDIT ACCOUNT
					</a>

				</div>
				<div class="my-2 col-12 col-lg-6">
					<a class="btn btn-danger btn-block" href="{{ route('student_profile_changep') }}">
						CHANGE PASSWORD
					</a>
				</div>


			</div>
		</div>
		<div class="col-12 col-md-9">
			<div class="form-group mt-2">
				<div class="col-12 col-md-6 mb-3">
					<input id="user_id" type="hidden" name="user_id" value="{{ $user->id }}" />
					<label for="fullname" class="text-light font-weight-bold mb-1">Full name</label>
					<input type="text" class="form-control form-control-sm bg-dark text-light border border-dark"
						id="fullname" placeholder="fullname"
						value="{{ strtoupper($user->student->last_name.', '.$user->student->first_name.' '.$user->student->middle_name) }}"
						readonly disabled>
				</div>
			</div>
			<div class="form-group">
				<div class="col-12 col-md-6 mb-3">
					<label for="birthday" class="text-light font-weight-bold mb-1">Birthday</label>
					<input type="text" class="form-control form-control-sm bg-dark text-light border border-dark"
						id="birthday" placeholder="birthday"
						value="{{ date('F d, Y',strtotime($user->student->birthdate)) }}" readonly disabled>
				</div>
			</div>
			<div class="form-group">
				<div class="col-12 col-md-6 mb-3">
					<label for="gender" class="text-light font-weight-bold mb-1">Gender</label>
					<input type="text" class="form-control form-control-sm bg-dark text-light border border-dark"
						id="gender" placeholder="gender" value="{{ $user->student->sex }}" readonly disabled>
				</div>
			</div>
			<div class="form-group">
				<div class="col-12 col-md-6 mb-3">
					<label for="address" class="text-light font-weight-bold mb-1">Address</label>
					<textarea rows="3" cols="30"
						class="form-control form-control-sm bg-dark text-light border border-dark" id="address"
						placeholder="address" readonly disabled>{{ ($user->student->address ? $user->student->address->house_lot.','
						.$user->student->address->street.','
						.$user->student->address->barangay->name.','
						.$user->student->address->city->name.','
						.$user->student->address->province->name
						: '')}}
					</textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-12 col-md-6 mb-3">
					<label for="school" class="text-light font-weight-bold mb-1">School</label>
					<input type="text" class="form-control form-control-sm bg-dark text-light border border-dark"
						id="school" placeholder="school"
						value="{{ ($user->student->school ? $user->student->school->name : '')}}" readonly disabled>
				</div>
			</div>
			<div class="form-group">
				<div class="col-12 col-md-6 mb-3">
					<label for="year_graduated" class="text-light font-weight-bold mb-1">Year Graduated</label>
					<input type="text" class="form-control form-control-sm bg-dark text-light border border-dark"
						id="year_graduated" placeholder="year_graduated" value="{{ $user->student->year_graduated }}"
						readonly disabled>
				</div>
			</div>

			<div class="h5 mt-5 pb-2 border-bottom border-dark text-light">Contact Details</div>

			<div class="form-group">
				<div class="col-12 col-md-6 mb-3">
					<label for="email" class="text-light font-weight-bold mb-1">Email</label>
					<input type="email" class="form-control form-control-sm bg-dark text-light border border-dark"
						id="email" placeholder="email" value="{{ $user->email }}" readonly disabled>
				</div>
			</div>

			<div class="form-group">
				<div class="col-12 col-md-6 mb-3">
					<label for="mobile_no" class="text-light font-weight-bold mb-1">Mobile No</label>
					<input type="text" class="form-control form-control-sm bg-dark text-light border border-dark"
						id="mobile_no" placeholder="mobile_no" value="{{ $user->student->mobile }}" readonly disabled>
					<small id="mobileHelp" class="form-text text-light">This mobile number will be use as alternative
						for google authenticator when logging in</small>
				</div>
			</div>

			<div class="h5 mt-5 pb-2 border-bottom border-dark text-light">Two-Factor Authentication</div>
			<button class="btn btn-outline-light btn-sm" data-toggle="modal" data-target="#qrConfirmModal">Generate QR
				Image</button>
			<small id="mobileHelp" class="form-text text-light">Scan this QR code using google authenticator application
				to verify your account when logging in. Download the google authenticator in playstore for android and
				app store for iOS devices.</small>

			<div class="mt-4 " id="qrImage">
				@isset($QR_Image)
				{!! $QR_Image !!}
				@endisset
			</div>

			@isset($QR_Image)
			<div class="custom-control custom-switch mb-5">
				<input type="checkbox" class="custom-control-input" id="customSwitch1">
				<label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
			</div>
			@endisset
		</div>

		<!--QR Confirm Modal-->
		<div class="modal fade" id="qrConfirmModal" tabindex="-1" aria-labelledby="qrConfirmModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body">
						<p>Generating a new QR image will invalidate any previous QR links in your Google Authenticator
							app. Are you sure you want to continue?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-success" id="generateQr">Generate QR
							Image</button>

					</div>
				</div>
			</div>
		</div>
		<!--QR Confirm Modal-->
	</div>
</div>


@endsection

@once
@push('scripts')

<script>
	$(document).ready(function(){
		jQuery("#generateQr").on("click",function() {			
			fetch('/student/generate-qr', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': '{{ csrf_token() }}' 
				},
				body: JSON.stringify({
        			id: $("#user_id").val()
				})
      			}).then(response => {
					
				}).catch(error => {
					
				});
		});
	});


			
</script>


@endpush
@endonce