<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LabelWithInput extends Component
{
    public string $label;
    public string $name;
    public string $type;
    public ?string $placeholder;
    public $value;
    public string $error;
    public $required;

    /**
     * Create a new component instance.
     */
    public function __construct(string $label = 'Label', string $name = 'name', string $type = 'text', $value = '', string $error = '', $required = null, ?string $placeholder = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->error = $error;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.label-with-input');
    }
}
