<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Province;
use App\Models\City;
use App\Models\Barangay;
use App\Models\School;
use App\Models\Address;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $user = User::where('id', Auth::user()->id)
                ->with('student')
                ->with('student.address')
                ->with('student.address.province')
                ->with('student.address.city')
                ->with('student.address.barangay')
                ->first();
        }

        /**
         * Google QR Code Generation
         */
        $google2fa = app('pragmarx.google2fa');
        $QR_Image = null;
        if ($user->google2fa_secret) {
            $QR_Image = $google2fa->getQRCodeInline(
                'AMICI',
                $user->email,
                $user->google2fa_secret
            );
        }
        /**************************/
        //return view('student.profile.index', compact('user'));
        return view('student.profile.index', ['user' => $user, 'QR_Image' => $QR_Image, 'secret' => $user->google2fa_secret]);
    }

    public function edit()
    {

        $user = null;
        if (Auth::user()) {
            $user = User::where('id', Auth::user()->id)
                ->with('student')
                ->with('student.address')
                ->first();
        }
        $provinces = Province::where('enabled', 1)->pluck('name', 'id');
        $provinceid = $user->student->address->province_id;
        $cities = City::where('enabled', 1)->where('province_id', $provinceid)->pluck('name', 'id');
        $cityid = $user->student->address->city_id;
        $barangays = Barangay::where('enabled', 1)->where('city_id', $cityid)->pluck('name', 'id');
        $schools = School::where('enabled', 1)->pluck('name', 'id');


        return view('student.profile.edit', compact('user', 'provinces', 'cities', 'barangays', 'schools'));
    }

    public function changep()
    {

        $user = Auth::user();
        return view('student.profile.changep', compact('user'));
    }

    public function savep(Request $request)
    {
        $result = false;
        $errormessage = "";
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $result = true;

            try {
                $user = User::find($request->id);
                $user->password = Hash::make($request->password);

                if (!$user->save())
                    $result = false;
            } catch (\Exception $e) {
                $result = false;
                $errormessage = $e->getMessage();
            }
        }
        if ($result)
            return redirect()->route('student_profile')->with('success', 'New password saved successfully!');
        else
            return back()->with('error', 'New password was not saved! ' . $errormessage);
    }
    public function save(Request $request)
    {
        $result = false;
        $errormessage = "";
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $result = true;

            try {
                if (isset($request->id) && strlen($request->id))
                    $student = Student::find($request->id);
                else
                    $student = new Student;
                $student->first_name = $request->first_name;
                $student->last_name = $request->last_name;
                $student->middle_name = $request->middle_name;
                $student->school_id = $request->school_id;
                $student->birthdate = $request->birthdate;
                $student->sex = $request->sex;
                $student->year_graduated = $request->year_graduated;
                $student->mobile = $request->mobile;

                if (isset($request->image)) {
                    //If image exist, delete the previous file:
                    if ($student->image) {
                        $filePath = public_path('images/' . $student->image);
                        if (File::exists($filePath)) {
                            File::delete($filePath);
                        }
                    }
                    $imageName = 'std_' . time() . '.' . $request->image->extension();
                    $request->image->move(public_path('images'), $imageName);
                    $student->image = $imageName;
                }
                if ($student->save()) {
                    $result = true;

                    if (isset($request->address_id) && strlen($request->address_id))
                        $address = Address::find($request->address_id);
                    else
                        $address = new Address;
                    $address->province_id = $request->province_id;
                    $address->city_id = $request->city_id;
                    $address->barangay_id = $request->barangay_id;
                    $address->house_lot = $request->house_lot;
                    $address->street = $request->street;
                    if ($address->save()) {
                    } else {
                        $result = false;
                    }
                } else {
                    $result = false;
                }
            } catch (\Exception $e) {
                $result = false;
                $errormessage = $e->getMessage();
            }
        }
        if ($result)
            return redirect()->route('student_profile')->with('success', 'Account saved successfully!');
        else
            return back()->with('error', 'Account changes was not saved! ' . $errormessage);
    }

    public function generateQr(Request $request)
    {
        $google2fa = app('pragmarx.google2fa');
        $user = User::find($request->id);
        /**
         * Google QR Code Generation
         */
        $newGoogleKey = ['google2fa_secret' => $google2fa->generateSecretKey()];
        $user->google2fa_secret = $newGoogleKey['google2fa_secret'];
        $user->save();

        $QR_Image = $google2fa->getQRCodeInline(
            'AMICI',
            $user->email,
            $user->google2fa_secret
        );
        /**************************/
        return redirect()->action([ProfileController::class, 'index']);;
        //return response()->json(['QR_Image' => $QR_Image, 'secret' => $newGoogleKey['google2fa_secret']]);
    }
}
