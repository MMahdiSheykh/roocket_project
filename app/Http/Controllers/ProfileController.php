<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

                $code = ActiveCode::generateNewCode($request->user());
                $request->session()->flash('phone_number', $data['phone_number']);

                return redirect(route('twoFactorAuth.phone'));
            } else {
                $request->user()->update([
                    'two_factor_auth_type' => 'SMS'
                ]);
            }
        }

        if($data['type'] === 'Off'){
            $request->user()->update([
                'two_factor_auth_type' => 'SMS'
            ]);
        }

        return back();
    }

    public function getPhoneVerify(Request $request)
    {
        if( ! $request->session()->has('phone_number')){
            return redirect(route('twoFactorAuth'));
        }

        $request->session()->reflash();

        return view('profile.phone-verify');

    }

    public function postPhoneVerify(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        if( ! $request->session()->has('phone_number')){
            return redirect(route('twoFactorAuth'));
        }


        $codeStatus = ActiveCode::verifyCode($request->token, $request->user());

        if($codeStatus) {
            $request->user()->activeCode()->delete();
            $request->user()->update([
                'phone_number' => $request->session()->get('phone_number'),
                'two_factor_auth_type' => 'SMS',
            ]);

            Alert::success('Well done!','Your phone number has been successfully verified')->persistent(true)->autoClose(3000);

        } else {
            Alert::error('Oops!','Your phone number could not be verified, please try again');
        }

        return redirect(route('twoFactorAuth'));
    }

}
