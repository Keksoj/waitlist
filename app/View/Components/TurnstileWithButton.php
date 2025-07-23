<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TurnstileWithButton extends Component
{
    public string $buttonText;

    /**
     * Create a new component instance.
     */
    public function __construct(string $buttonText = 'Submit')
    {
        $this->buttonText = $buttonText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.turnstile-with-button');
    }
}
