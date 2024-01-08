@extends('layouts.app')

@section('content')
<section class="page-section" id="services">
    <br />
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white bg-dark m-1">
                    
                    <i class="fas fa-feather mx-3"></i>
                    
                    {{ __('Join Us - Sign Up Now') }}
                
                </div>
                <div class="card-body">
                    @include('flash-message')
                    <form method="POST" action="{{ route('register') }}" id="registration-frm" novalidate>
                        @csrf
                        <input id="role" type="hidden"  name="role" value="student" />
					
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-4">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="password-confirm" class="col-md-2 col-form-label text-md-right align-self-center">{{ __('Confirm') }}</label>

                            <div class="col-md-4">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <hr />
                        <div class="form-group row">
                            <label for="first_name" class="col-md-2 col-form-label text-md-right">{{ __('First Name') }}</label>
                            <div class="col-md-4">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" >
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="last_name" class="col-md-2 col-form-label text-md-right align-self-center">{{ __('Last Name') }}</label>
                            <div class="col-md-4">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" >
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birthdate" class="col-md-2 col-form-label text-md-right">{{ __('Birthdate') }}</label>
                            <div class="col-md-4">
                                <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}" required autocomplete="birthdate" >
                                @error('birthdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="sex" class="col-md-2 col-form-label text-md-right align-self-center">{{ __('Gender') }}</label>
                            <div class="col-md-4  align-self-center">
                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" required name="sex" id="sexM" value="M">
                                    <label class="form-check-label" for="sexM"> MALE </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" required name="sex" id="sexF" value="F">
                                    <label class="form-check-label" for="sexF"> FEMALE </label>
                                </div>
                                @error('sex')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('School') }}</label>
                            <div class="col-md-4">
                                <input id="school_name" style="display:none;" type="text" class="form-control @error('school_name') is-invalid @enderror" name="school_name" value="{{ old('school_name') }}" autocomplete="school_name" >
                                <select id="school_id" class="form-control @error('school_id') is-invalid @enderror" name="school_id" value="{{ old('school_id') }}" required >
                                    @foreach($schools as $schoolid => $school)
                                        <option value="{{ $schoolid }}">{{ $school }}</option>
                                    @endforeach
									<option value="NEW">ENTER SCHOOL NAME</option>
                                </select>
                                @error('school_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="year_graduated" class="col-md-2 col-form-label text-md-right">{{ __('Graduated') }}</label>
                            <div class="col-md-4">
                                <input id="year_graduated" type="number" min="2000" max="{{date('Y')}}" step="1" class="form-control @error('year_graduated') is-invalid @enderror" name="year_graduated" value="{{ old('year_graduated') }}" required autocomplete="year_graduated" >
                                @error('year_graduated')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('Province') }}</label>
                            <div class="col-md-4">
                                <select id="province_id" onchange="setProvince(this);" class="form-control @error('province_id') is-invalid @enderror" name="province_id" value="{{ old('province_id') }}" required >
                                    <option value=""></option>
                                    @foreach($provinces as $provinceid => $province)
                                        <option value="{{ $provinceid }}">{{ $province }}</option>
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
                                <select id="city_id" onchange="setCity(this);" class="form-control @error('city_id') is-invalid @enderror" name="city_id" value="{{ old('city_id') }}" required >
                                    
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
                                <select id="barangay_id" class="form-control @error('barangay_id') is-invalid @enderror" name="barangay_id" value="{{ old('barangay_id') }}" required >
                                    
                                </select>
                                @error('barangay_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="street" class="col-md-2 col-form-label text-md-right">{{ __('Street') }}</label>
                            <div class="col-md-4">
                                <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" autocomplete="street" >
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
                                <input id="house_lot" type="text" class="form-control @error('house_lot') is-invalid @enderror" name="house_lot" value="{{ old('house_lot') }}" autocomplete="house_lot" >
                                @error('house_lot')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('Mobile No') }}</label>
                            <div class="col-md-4">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" >
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Sign Up') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@once
	@push('scripts')

		<script>
			var stype = 1;
			jQuery(document).ready(function(){
				jQuery('#school_id').change(function(){
					if(jQuery(this).val() == "NEW"){
						jQuery(this).hide();
						jQuery(this).removeAttr('required');
						jQuery('#school_name').show();
						jQuery('#school_name').attr('required','required');
						jQuery('#school_name').focus();
					}					
				});
				
				$('form#registration-frm').submit(function(e) {
					var form = $(this);

					if (form[0].checkValidity() === false) {
						
						form.addClass('was-validated');
						jQuery('html,body').animate({
							scrollTop: jQuery('.was-validated .form-control:invalid').first().offset().top - (parseInt(jQuery('.navbar:first').height()) + 50)
							},
							'slow'
						);
						jQuery('.was-validated .form-control:invalid').first().focus();
						e.preventDefault();
						e.stopPropagation();
						return;
					}
					
				});
			});
		</script>
	@endpush
@endonce