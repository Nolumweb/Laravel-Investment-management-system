<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    // public function create(array $input): User
    // {
    //     $referralCode = request()->query('ref');

    //     Validator::make($input, [
    //         'name' => ['required', 'string', 'min:3', 'max:20'],
    //         'username' => ['required', 'string', 'alpha_dash', 'min:3', 'max:11', 'unique:users'],
    //         'email' => ['required', 'string', 'email', 'max:20', 'unique:users'],
    //         'password' => $this->passwordRules(),
    //         'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
    //     ])->validate();
    
    //     // Generate referral code
    //     $referralCode = $input['username'] . '-' . Str::random(3);
    
    //     // Pass referral code to registration view
    //     session()->flash('referralCode', $referralCode);
    //     return User::create([
    //         'name' => $input['name'],
    //         'username' => $input['username'],
    //         'email' => $input['email'],
    //         'password' => Hash::make($input['password']),
    //         'referral_code' => $referralCode,
    //     ]);
    // }
    

public function create(array $input): User
{

    Validator::make($input, [
        'name' => ['required', 'string', 'min:3', 'max:20'],
        'username' => ['required', 'string', 'alpha_dash', 'min:3', 'max:11', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => $this->passwordRules(),
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        'referral' => 'nullable|exists:referral_codes,code',

        ])->validate();

    // Include referral code if provided
    $userData = [
        'name' => $input['name'],
        'username' => $input['username'],
        'email' => $input['email'],
        'password' => Hash::make($input['password']),
    ];

  
    
    // if ($request->filled('referral_code')) {
    //     $userData['referral_code'] = $request->input('referral_code');
    // }

    if (isset($input['referral'])) {
        $userData['referral'] = $input['referral'];
    }
    $user = User::create($userData);
    return $user;


}


}
