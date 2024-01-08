<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Student;
use App\Models\Province;
use App\Models\Address;
use App\Models\School;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/email/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $provinces = Province::where('enabled',1)->pluck('name','id');
        $provinceid = array_key_first($provinces->toArray());
        $schools = School::where('enabled',1)->orderBy('name')->pluck('name','id');
        return view('auth.register',compact('schools','provinces'));
    }


    /** 
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     *
     * taken from Illuminate\Foundation\Auth\RegistersUsers - overides
     * 
     */

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // undecided if will be removed
        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
			'role' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $result = false;
		$errormessage = "";
		
        try{
            DB::beginTransaction();
            $result = true;
            $user = new User;
            $user->role =  $data['role'];
            $user->email =  $data['email'];
            $user->password =  Hash::make($data['password']);
            Log::info($data);
            if($user->save()){
                $student = new Student;
                $student->auth_user_id = $user->id;
                $student->last_name = $data['last_name'];
                $student->first_name = $data['first_name'];
                $student->birthdate = $data['birthdate'];
                $student->sex = $data['sex'];
                $student->status = Student::STATUS_NEW;
                $student->date_registered = date('Y-m-d H:i:s');
				
				if(isset($data['school_id']) && strlen($data['school_id']) && $data['school_id'] != "NEW")
					$student->school_id = $data['school_id'];
                else if(isset($data['school_name']) && strlen($data['school_name'])){
					$school = new School;
					$school->name = $data['school_name'];
					$school->enabled = 1;
					Log::info($school);
					if($school->save()){
						$student->school_id = $school->id;
					}else{
						Log::info('notsaved');
					}
				}
				
				$student->year_graduated = $data['year_graduated'];
                $student->mobile = $data['mobile'];
                if($student->save()){
                    
                    $address = new Address;
                    $address->student_id = $student->id;
                    $address->province_id = $data['province_id'];
                    $address->city_id = $data['city_id'];
                    $address->barangay_id = $data['barangay_id'];
                    if(isset($data['street']))
                        $address->street = $data['street'];
                    if(isset($data['house_lot']))
                        $address->house_lot = $data['house_lot'];
                    if($address->save()){

                    }else{
                        $result = false;
                    }


                }else{
                    $result = false;
                }
            }else{
                $result = false;
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $result = false;
            $errormessage = $e->getMessage();
            
        }
    
        return $user;
    }
}
