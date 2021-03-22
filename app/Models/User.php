<?php

namespace App\Models;

use Carbon\Carbon;
use App\Contracts\Roles;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use App\Traits\HasTimestampAttributes;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notifiable;
use Zauth\Traits\UserHasZrole as HasRoles;
use Zauth\Traits\UserHasZtokens as HasTokens;
use App\Notifications\Emails\RegisteredEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Zauth\Traits\UserHasZclients as HasClients;
use App\Notifications\Emails\PasswordResetEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Roles, MustVerifyEmail
{
    use HasRoles;
    use HasTokens;
    use HasClients;
    use HasFactory;
    use Notifiable;
    use HasTimestampAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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


    /**
     * Returns the role title of this user.
     * 
     * @param mixed $value
     * @return string|null|mixed
     */
    public function getRoleNameAttribute($value)
    {
        if ($role = $this->role) {
            $role = $role->name();
            return !is_null($role) ? ucfirst($role) : null;
        }
        return $value;
    }

    /**
     * Returns the email verified status of this user, available as the `status` field
     * when serialized.
     * 
     * @return bool
     */
    public function getStatusAttribute($value)
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Returns the redirect url string. This can be useful when the user logins and has
     * to be redirected to a different page.
     * 
     * @return string|null
     */
    public function getRedirectToAttribute()
    {
        return request('redirect_to');
    }

    /**
     * Returns the validation rules of this model.
     * 
     * If a User model is passed as an argument, then the validation should ignore
     * the given user model when performing a unique index check.
     * 
     * @param \App\Models\User $user
     * @return array
     */
    public static function validationRules($user = null)
    {
        $unique_user = Rule::unique('users');

        if (!is_null($user)) {
            $unique_user = $unique_user->ignoreModel($user);
        }

        return [
            'email' => ['required', 'string', 'email', 'max:255', $unique_user],
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    /**
     * Gets the token expiry set by the user. Override this function
     * on \App\User to have custom expiry duration.
     * 
     * @return int
     */
    public function getTokenExpiry()
    {
        return $this->token_expiry = 12;
    }

    /**
     * Sends the email verification notification to this user.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new RegisteredEmail($this->verificationUrl()));
    }

    /**
     * Sends the password reset notification to this user.
     * 
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetEmail(
            $this->passwordResetUrl($token, $this->getEmailForPasswordReset())
        ));
    }

    /**
     * Returns a url for auth verification. The url is a temporary signed url
     * that expires in 2 days or the expiry days set in the auth config file - 
     * auth.verification.expiry_days
     * 
     * @return string
     */
    public function verificationUrl()
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addDays(Config::get('auth.verification.expire_in_days', 2)),
            ['id' => $this->getKey()]
        );
    }

    /**
     * Returns the password reset url for the given token and email address.
     * 
     * @param string $token
     * @param string $email
     * @return string
     */
    public function passwordResetUrl($token, $email)
    {
        return route('password.reset', ['token' => $token, 'email' => $email]);
    }
}
