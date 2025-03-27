<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Company;
use Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $email_arr = explode('@', $googleUser->email);
                $domain = end($email_arr);
                $password = Hash::make(reset($email_arr).'123!');

                $company = $this->getCompanyByDomain($domain);

                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => $password,
                    'google_id' => $googleUser->id,
                    'company_id' => $company->id ?? NULL
                ]);

                $user->assignRole('user');
            }

            Auth::login($user);

            return redirect()->route('home'); // Redirect to dashboard
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong.');
        }
    }

    private function getCompanyByDomain($domain) {
        $company_arr = [
            'kojiesan.com'          => 'BEVI',
            'beviasiapacific.com'   => 'BEVA',
            'thepbb.com'            => 'PBB',
            'bevmi.com'             => 'BEVM',
            'onestandpoint.com'     => 'OSP',
            'breedwinner.com'       => 'BREEDWINNER',
        ];

        $company = NULL;
        if(!empty($company_arr[$domain])) {
            $company = Company::where('name', $company_arr[$domain])
                ->first();
        }

        return $company;

    }
}
