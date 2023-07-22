<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Recaptcha extends Component
{
    public $clientKey;
    public $hasError;
    /**
     * Create a new component instance.
     */
    public function __construct(bool $hasError)
    {
        $this->clientKey = env('GOOGLE_RECAPTCHA_SITE_KEY');
        $this->hasError = $hasError;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.recaptcha');
    }
}
