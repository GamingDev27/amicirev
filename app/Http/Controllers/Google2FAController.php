<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Google2FAController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('google2fa.index');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $google2fa = new \PragmaRX\Google2FA\Google2FA();
        $user = auth()->user();
        $valid =  $google2fa->verifyKey($user->google2fa_secret, $request->input('one_time_password'));
        if ($valid) {
            $request->session()->put('user_2fa.auth_passed', true);
            $request->session()->put('user_2fa.auth_time', Carbon::now()->format('Y-m-d\TH:i:sP'));
            return redirect()->route('student_profile');
        }

        //return back()->withErrors(['one_time_password' => 'Invalid OTP code']);
        return back()->with('error', 'You entered wrong code.');
    }


    public function getQRCode()
    {
        $google2fa = app('pragmarx.google2fa');

        $user = User::findOrFail(auth()->user()->id);
        $newGoogleKey = ['google2fa_secret' => $user->google2fa_secret];

        if (!$user->google2fa_secret) {
            $newGoogleKey['google2fa_secret'] = $google2fa->generateSecretKey();
            $user->google2fa_secret = $newGoogleKey['google2fa_secret'];
            $user->save();
        }

        $QR_Image = $google2fa->getQRCodeInline(
            'AMICI',
            $user->email,
            $newGoogleKey['google2fa_secret']
        );

        return response()->json(['QR_Image' => $QR_Image, 'secret' => $newGoogleKey['google2fa_secret']]);
    }
}
