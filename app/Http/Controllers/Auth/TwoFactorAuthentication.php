<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\ActiveCode;

trait TwoFactorAuthentication
{
    public function loggedIn(Request $request, $user)
    {
        if($user->isTwoFactorAuthEnabled()){
            auth()->logout();

            $request->session()->flash('auth', [
                'user_id' => $user->id,
                'using_SMS' => false,
                'remember' => $request->has('remember'),
            ]);

            if($user->two_factor_auth_type === 'SMS'){

                $code = ActiveCode::generateNewCode($user);

                $request->session()->push('auth.using_SMS', true);
            }

            return redirect(route('twoFactorAuth.token'));

        }

        return false;
    }
}
