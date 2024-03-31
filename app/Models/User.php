<?php

namespace App\Models;

use App\Mail\SendEmailVerification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google2fa_secret'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function student()
    {
        return $this->hasOne('App\Models\Student', 'auth_user_id');
    }

    /**
     * Set the google's 2fa code.
     *
     * @param  string  $value
     * @return string
     */
    protected function google2faSecret(): Attribute
    {
        return new Attribute(
            function ($value) {
                try {
                    return decrypt($value);
                } catch (DecryptException $e) {
                    // Handle decryption exception
                    return null;
                }
            },

            function ($value) {
                try {
                    return encrypt($value);
                } catch (EncryptException $e) {
                    // Handle encryption exception
                    return null;
                }
            }
        );
    }

    /**
     * Generate a random number for email verification
     * and send the randomize number for mail queueing.
     */
    public function generateCode()
    {
        //create a random code for email verification
        $code = rand(100000, 999999);

        UserCode::updateOrCreate(
            ['user_id' => auth()->user()->id],
            ['code' => $code]
        );

        try {
            $mailDetails = [
                'company' => 'Amici Review Center',
                'first_name' => 'Justine',
                'title' => 'Email Verification from Amici Review Center',
                'code' => $code
            ];
            Mail::to(auth()->user()->email)->queue(new SendEmailVerification($mailDetails));
        } catch (Exception $e) {
            info("Error: " . $e->getMessage());
        }
    }
}
