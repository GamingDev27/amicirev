@extends('layouts.admin')

@section('content')
	<h3 class="mt-4">Edit Account
		<a class="btn btn-outline-primary float-right" href="{{ route('student_profile')}}"> <i class="fas fa-reply"></i> BACK </a> 
	</h3>
	
	<form method="POST" id="contentForm" action="{{ route('student_profile_save') }}" enctype="multipart/form-data">
		@csrf
		<div class="row align-items-stretch mb-5">
			<div class="col-md-4">
				@if(isset($user->student->image) && strlen($user->student->image))
					<input type="file" id="imageInput" name="image" >
					<img class="mx-auto rounded-circle" id="imagePreview" alt="Image Preview Here" src="/images/{{$user->student->image}}" style="max-width:80%;" />
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
				<div class="form-group row">
					<label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('FIRSTNAME') }}</label>
					<input id="id" type="hidden" name="id" value="{{ $user->student->id }}" />
					<input id="first_name" type="text" class="form-control col-md-10  @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->student->first_name }}" required autocomplete="first_name" autofocus>
					@error('first_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('MIDDLENAME') }}</label>
					<input id="middle_name" type="text" class="form-control col-md-10 @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ $user->student->middle_name }}" required autocomplete="middle_name" >
					@error('middle_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group row">
				<label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('LASTNAME') }}</label>
					<input id="last_name" type="text" class="form-control col-md-10 @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->student->last_name }}" required autocomplete="last_name" >
					@error('last_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="row">

					<label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('BIRTHDATE') }}</label>
					<div class="form-group col-4">
						<input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ $user->student->birthdate }}" required autocomplete="birthdate" >
						@error('birthdate')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('GENDER') }}</label>
					<div class="form-group  col-4">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" {{ $user->student->sex =='M'?'checked="checked"':'' }} required name="sex" id="sexM" value="M">
							<label class="form-check-label" for="sexM"> MALE </label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" {{ $user->student->sex =='F'?'checked="checked"':'' }} required name="sex" id="sexF" value="F">
							<label class="form-check-label" for="sexF"> FEMALE </label>
						</div>
						@error('sex')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<hr />
				<div class="form-group row">
					<label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('SCHOOL') }}</label>
					<div class="col-md-4">
						<select id="school_id" class="form-control @error('school_id') is-invalid @enderror" name="school_id" value="{{ old('school_id') }}" required >
							@foreach($schools as $schoolid => $school)
								<option value="{{ $schoolid }}" {{ $user->student->school_id ==$schoolid?'selected="selected"':'' }}>{{ $school }}</option>
							@endforeach
						</select>
						@error('school_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<label for="year_graduated" class="col-md-2 col-form-label text-md-right">{{ __('GRADUATED') }}</label>
					<div class="col-md-4">
						<input id="year_graduated" type="number" min="2000" max="{{date('Y')}}" step="1" class="form-control @error('year_graduated') is-invalid @enderror" name="year_graduated" value="{{ $user->student->year_graduated }}" required autocomplete="year_graduated" >
						@error('year_graduated')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<input id="id" type="hidden" name="address_id" value="{{ $user->student->address->id }}" />
					<label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('PROVINCE') }}</label>
					<div class="col-md-4">
						<select id="province_id" onchange="setProvince(this);" class="form-control @error('province_id') is-invalid @enderror" name="province_id" required >
							<option value=""></option>
							@foreach($provinces as $provinceid => $province)
								<option value="{{ $provinceid }}" {{ $user->student->address->province_id == $provinceid?'selected="selected"':'' }}>{{ $province }}</option>
							@endforeach
						</select>
						@error('province_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('City') }}</label>
					<div class="col-md-4">
						<select id="city_id" onchange="setCity(this);" class="form-control @error('city_id') is-invalid @enderror" name="city_id" required >
							@foreach($cities as $cityid => $city)
								<option value="{{ $cityid }}" {{ $user->student->address->city_id ==$cityid?'selected="selected"':'' }}>{{ $city }}</option>
							@endforeach
						</select>
						@error('city_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('Barangay') }}</label>
					<div class="col-md-4">
						<select id="barangay_id" class="form-control @error('barangay_id') is-invalid @enderror" name="barangay_id" required >
							@foreach($barangays as $barangayid => $barangay)
								<option value="{{ $barangayid }}" {{ $user->student->barangay_id ==$barangayid?'selected="selected"':'' }} >{{ $barangay }}</option>
							@endforeach
						</select>
						@error('barangay_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<label for="street" class="col-md-2 col-form-label text-md-right">{{ __('Street') }}</label>
					<div class="col-md-4">
						<input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ $user->student->address->street }}" autocomplete="street" >
						@error('street')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
					
				<div class="form-group row">
					<label for="house_lot" class="col-md-2 col-form-label text-md-right">{{ __('House No.') }}</label>
					<div class="col-md-4">
						<input id="house_lot" type="text" class="form-control @error('house_lot') is-invalid @enderror" name="house_lot" value="{{ $user->student->address->house_lot }}" autocomplete="house_lot" >
						@error('house_lot')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('Mobile No') }}</label>
					<div class="col-md-4">
						<input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $user->student->mobile }}" required autocomplete="mobile" >
						@error('mobile')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
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
			});
		</script>
	@endpush
@endonce

