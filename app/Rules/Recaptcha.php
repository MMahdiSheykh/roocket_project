<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

public function passes($attribute, $value)
{

    try{
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('GOOGLE_RECAPTCHA_SECRET_KEY'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);
        dd($response->json());
        $response = json_decode($response->getBody());

        return $response->success;

        } catch (\Exception $e){
            $e->getMessage();
            return false;
        }
    }

    public function message()
    {
        return 'Are you a robot? 🙄';
    }
}
