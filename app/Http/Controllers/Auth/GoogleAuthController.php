<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;

class GoogleAuthController extends Controller
{
    use TwoFactorAuthentication;
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->email)->first();

            if( ! $user){
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt(Str::random())
                ]);
            }

            auth()->loginUsingId($user->id);

            Alert::success('well done!', 'Welcome to your user panel');
            return $this->loggedIn($request, $user) ?: redirect('/');

        } catch (\Exception $e) {
            Alert::error('Login failed!','Your login was not successful!');
            return redirect('/');
        }
    }
}
