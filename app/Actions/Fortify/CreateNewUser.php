<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validateWithBag('reg');




        $image=uniqid()."jpg";

        $file = public_path('storage/profile-photos/admin/default.jpg');
        $newfile = public_path('storage/profile-photos/'.$image);

        copy($file,$newfile);

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'profile_photo_path' => 'profile-photos/'.$image,
            'password' => Hash::make($input['password']),
        ]);


        $toastrMsg=array(
            'message' => 'You are now registered!',
            'alert-type' => 'success'
        );
        return redirect()->url('/')->with($toastrMsg);
        
    }
}
