<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function mangeTwoFactor()
    {
        return view('profile.two-factor-auth');
    }

    public function postManageTwoFactor(Request $request)
    {
        $data = $request->validate([
            'type' =>'required|in:SMS,Off',
            'phone_number' =>'required_if:type,SMS',
        ]);

        if($data['type'] === 'SMS'){
            if($request->user()->phone_number !== $data['phone_number']){
                return redirect(route('twoFactorAuth.phone'));
            } else {
                $request->user->update([
                    'two_factor_auth_type' => 'Off'
                ]);
            }
        }

        if($data['type'] === 'Off'){
            $request->user()->update([
                'two_factor_auth_type' => 'Off'
            ]);
        }

        return back();
    }

    public function getPhoneVerify()
    {
        return view('profile.phone-verify');
    }

    public function postPhoneVerify(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        return $request->token;
    }

}
