<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ReferralCode;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasOne;

 class User extends Authenticatable
//class User extends Authenticatable implements MustVerifyEmail
{

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'ustatus',
        'email_verified',
        'two_factor_enabled',
        'referral', 


    ];


    protected static function booted()
    {
        static::created(function ($user) {
            $referralCode = Str::slug($user->username, ''); // Generating a slug from the username
            $suffix = '';
            while ($user->referralCode()->where('code', $referralCode . $suffix)->exists()) {
                $suffix = Str::random(2); // Append random suffix if the code exists
            }
            $user->referralCode()->create(['code' => $referralCode . $suffix]);
        });
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
  
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function kycDocuments()
    {
        return $this->hasMany(KYCDocument::class);
    }
  

    public function referralCode(): HasOne
    {
        return $this->hasOne(ReferralCode::class, 'user_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
