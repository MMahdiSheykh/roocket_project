<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AuthTokenController extends Controller
{
    public function getToken(Request $request)
    {
        if( ! $request->session()->has('auth')) {
            return redirect(route('login'));
        } else {

            $request->session()->reflash();

            return view('auth.token');
        }
    }

    public function postToken(Request $request)
    {

        $request->validate([
            'token' => 'required'
        ]);

        if( ! $request->session()->has('auth')) {
            return redirect(route('login'));
        }

        $user = User::findOrFail($request->session()->get('auth.user_id'));

        $status = ActiveCode::verifyCode($request->token, $user);

        if( ! $status){
            Alert::error('Oops!', 'The entered code is not correct!');
            return redirect(route('login'));
        }

        if(auth()->loginUsingId($user->id, $request->session()->get('auth.remember'))){
            $user->activeCode()->delete();

            Alert::success('well done!', 'Two-step authentication has been successfully completed!');

            return redirect('/');
        }

        return redirect(route('login'));
    }
}
