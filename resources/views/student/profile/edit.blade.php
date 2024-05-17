@extends('layouts.student')

@section('content')
<div class="container-fluid bg-secondary h-100 w-100 mh-100" style="height: 100vh;min-height: 100vh">
	<h4 class="pt-4 text-light">
		Edit Profile
		<a class="btn btn-light float-right" href="{{ route('student_profile')}}"> <i class="fas fa-reply"></i> BACK
		</a>
	</h4>

	<hr class="bg-dark" />
	<form method="POST" id="contentForm" action="{{ route('student_profile_save') }}" enctype="multipart/form-data">
		@csrf
		<div class="row mb-4">
			<!--Image Preview-->
			<div class="col-12 col-lg-3 px-3 my-2">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="imageInput" name="image" accept="image/*">
					<label class=" custom-file-label" for="imageInput">Choose file</label>
				</div>
				<img class="rounded-circle mx-auto mt-3" id="imagePreview" alt="Image Preview Here"
					src="{{ ($user->student->image ? '/images/'.$user->student->image : '/images/user.png') }}"
					style="max-width:90%;" />
				@error('image')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>

			<!--Form Input-->
			<div class="col-12 col-lg-9">
				<!-- First & Middle Name -->
				<div class="form-group row mt-2 pr-3">
					<input id="id" type="hidden" name="id" value="{{ $user->student->id }}" />

					<label for="first_name"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">Firstname</label>
					<input id="first_name" type="text"
						class="form-control form-control-sm bg-dark text-light border border-dark col-8 col-lg-4  @error('first_name') is-invalid @enderror"
						name="first_name" value="{{ $user->student->first_name }}" required autocomplete="first_name"
						autofocus>

					@error('first_name')
					<span class="invalid-feedback text-center" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror

					<label for="middle_name"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">Middlename</label>
					<input id="middle_name" type="text"
						class="form-control form-control-sm bg-dark text-light border border-dark col-8 col-lg-4  @error('middle_name') is-invalid @enderror"
						name="middle_name" value="{{ $user->student->middle_name }}" required autocomplete="middle_name"
						autofocus>

					@error('middle_name')
					<span class="invalid-feedback text-center" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				<!-- Last Name & Gender -->
				<div class="form-group row pr-3">
					<label for="last_name"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">Lastname</label>
					<input id="last_name" type="text"
						class="form-control form-control-sm bg-dark text-light border border-dark col-8 col-lg-4  @error('last_name') is-invalid @enderror"
						name="last_name" value="{{ $user->student->last_name }}" required autocomplete="last_name"
						autofocus>
					@error('last_name')
					<span class="invalid-feedback text-center" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror


					<label for="gender"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">Gender</label>

					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" {{ $user->student->sex
						=='M'?'checked="checked"':'' }} required name="sex" id="sexM" value="M">
						<label class="form-check-label" for="sexM"> MALE </label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" {{ $user->student->sex
						=='F'?'checked="checked"':'' }} required name="sex" id="sexF" value="F">
						<label class="form-check-label" for="sexF"> FEMALE </label>
					</div>
					@error('sex')
					<span class="invalid-feedback text-center" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				<!-- Birthday -->
				<div class="form-group row pr-3">
					<label for="birthdate"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">Birthdate</label>
					<input id="birthdate" type="text"
						class="form-control form-control-sm bg-dark text-light border border-dark col-8 col-lg-4  @error('birthdate') is-invalid @enderror"
						name="birthdate" value="{{ $user->student->birthdate }}" required autocomplete="birthdate"
						autofocus>
					@error('birthdate')
					<span class="invalid-feedback text-center" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				<!-- School & Year -->
				<div class="form-group row pr-3">
					<label for="school_id"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">School</label>
					<select id="school_id" class="form-control form-control-sm bg-dark text-light border border-dark col-8 col-lg-4
					 @error('school_id') is-invalid @enderror" name="school_id" value="{{ old('school_id') }}" required>
						@foreach($schools as $schoolid => $school)
						<option value="{{ $schoolid }}" {{ $user->student->school_id
							==$schoolid?'selected="selected"':'' }}>{{ $school }}</option>
						@endforeach
					</select>

					@error('school_id')
					<span class="invalid-feedback text-center" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror

					<label for="year_graduated"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">Graduated</label>
					<input id="year_graduated" type="number" min="1985" max="{{date('Y')}}" step="1"
						class="form-control form-control-sm bg-dark text-light border border-dark col-8 col-lg-4  @error('year_graduated') is-invalid @enderror"
						name="year_graduated" value="{{ $user->student->year_graduated }}" required
						autocomplete="year_graduated" autofocus>

					@error('year_graduated')
					<span class="invalid-feedback text-center" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				<div class="h5 mt-4 pb-2 border-bottom border-dark text-light">Address</div>

				<!-- Address Province & City -->
				<div class="form-group row pr-3">
					<input id="id" type="hidden" name="address_id" value="{{ $user->student->address->id }}" />
					<label for="province_id"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">Province</label>
					<select id="province_id" onchange="setProvince(this);" class="form-control form-control-sm bg-dark text-light border border-dark col-8 col-lg-4
					 @error('province_id') is-invalid @enderror" name="province_id" value="{{ old('province_id') }}" required>
						<option value=""></option>

						@foreach($provinces as $provinceid => $province)
						<option value="{{ $provinceid }}" {{ $user->student->address->province_id ==
							$provinceid?'selected="selected"':'' }}>{{ $province }}</option>
						@endforeach
					</select>

					@error('province_id')
					<span class="invalid-feedback text-center" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror


					<label for="city_id"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">City</label>
					<select id="city_id" onchange="setCity(this);" class="form-control form-control-sm bg-dark text-light border border-dark col-8 col-lg-4
					 @error('city_id') is-invalid @enderror" name="city_id" value="{{ old('city_id') }}" required>
						@foreach($cities as $cityid => $city)
						<option value="{{ $cityid }}" {{ $user->student->address->city_id
							==$cityid?'selected="selected"':'' }}>{{ $city }}</option>
						@endforeach
					</select>
					@error('city_id')
					<span class="invalid-feedback text-center" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				<!-- Address Barangay & Street -->
				<div class="form-group row pr-3">
					<label for="barangay_id"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">Barangay</label>
					<select id="barangay_id" class="form-control form-control-sm bg-dark text-light border border-dark col-8 col-lg-4
					 @error('barangay_id') is-invalid @enderror" name="barangay_id" value="{{ old('barangay_id') }}" required>
						@foreach($barangays as $barangayid => $barangay)
						<option value="{{ $barangayid }}" {{ $user->student->barangay_id
							==$barangayid?'selected="selected"':'' }} >{{ $barangay }}</option>
						@endforeach
					</select>
					@error('barangay_id')
					<span class="invalid-feedback text-center" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror


					<label for="street"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">Street</label>

					<input id="street" type="text"
						class="form-control form-control-sm bg-dark text-light border border-dark col-8 col-lg-4  @error('street') is-invalid @enderror"
						name="street" value="{{ $user->student->address->street }}" required autocomplete="street"
						autofocus>
					@error('street')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				<!-- Address House No -->
				<div class="form-group row pr-3">
					<label for="house_lot"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">House
						No</label>

					<input id="house_lot" type="text"
						class="form-control form-control-sm bg-dark text-light border border-dark col-8 col-lg-4  @error('house_lot') is-invalid @enderror"
						name="house_lot" value="{{ $user->student->address->house_lot }}" required
						autocomplete="house_lot" autofocus>
					@error('house_lot')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				<div class="h5 mt-4 pb-2 border-bottom border-dark text-light">Contact Details</div>

				<!-- Mobile No -->
				<div class="form-group row pr-3">
					<label for="mobile"
						class="col-form-label text-light font-weight-bold col-4 col-lg-2 text-wrap text-md-right">Mobile
						No</label>

					<input id="mobile" type="text"
						class="form-control form-control-sm bg-dark text-light border border-dark col-8 col-lg-4  @error('mobile') is-invalid @enderror"
						name="mobile" value="{{ $user->student->mobile }}" required autocomplete="mobile" autofocus>
					@error('mobile')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				@isset($QR_Image)
				<div class="h5 mt-5 pb-2 border-bottom border-dark text-light">Two-Factor Authentication</div>
				<div class="mt-4 mb-1" id="qrImage">
					{!! $QR_Image !!}
				</div>
				<div class="form-group row p-3">
					<input type="checkbox" {{ $user->use_google2fa ? 'checked' : '' }}
					data-toggle="toggle" data-size="sm" class="float-left"
					name="use_google2fa">
					<label for="house_lot" class="col-form-label text-light col-10 col-lg-8 text-md-left py-0">Use
						Google QR Image as my primary login verification.</label>
				</div>
				@endisset

				<div class="h5 mt-5 pb-2 border-bottom border-dark text-light">Active Devices</div>
				<p class="form-text text-light">
					You are currently signed in to Amici Review Center using the following devices:
				</p>

				<div class="d-flex flex-wrap" style="gap: 1rem">
					@foreach($user->devices as $index => $device)
					@include('student.profile._card-device-info',['allowEditing' => true])
					@endforeach
				</div>
				<hr class="bg-dark" />
				<div class="col-12 col-lg-6">
					<button class="btn btn-primary btn-xl text-uppercase btn-block" id="sendMessageButton"
						type="submit">Save</button>
				</div>


			</div>
	</form>
</div>

@include('student.profile.modal.delete-device-confirmation')
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
				var fileName = $('#imageInput').val().split('\\').pop();
				$('.custom-file-label').text(fileName);
		});
		jQuery('#birthdate').datepicker({
			format: 'yyyy-mm-dd',
			toggleActive: true,
			todayBtn: "linked",
			changeMonth: true,
			changeYear: true,
			orientation:"bottom"
		});	

		jQuery("a.delete-device").on("click",function() {			
			//assign deviceId to modal
			$('#device-id').html($(this).data('id'));

		});

		jQuery("button.delete-device-confirm").on("click",function(){
			const deviceId = $("#device-id").text();
			let routeUrl = "{{ route('student_profile_delete_device',':deviceId') }}";
			routeUrl = routeUrl.replace(':deviceId',deviceId);
			
			$.ajax({
				url: routeUrl,
				type: 'DELETE',
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
        	},
            success: function(data) {
				if(data.success){
					$('#deleteDeviceModal').modal('hide');
					setTimeout(function() {
                        location.reload();
                    }, 1000); // 2-second delay
				}
				
				
			},
			error: function(data) {
                    alert('Error deleting record.');
            }
			});
		});

	});

</script>
@endpush
@endonce