<?php

namespace App\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionLink extends Component
{
    public string $title;
    public string $href;

    public function __construct(string $title = 'Action Link', string $href = '#')
    {
        $this->title = $title;
        $this->href = $href;
    }

    public function render(): View
    {
        return view('components.buttons.action-link');
    }
}
