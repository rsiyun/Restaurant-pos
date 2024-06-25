<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class inputSelect extends Component
{
    /**
     * Create a new component instance.
     */
    public array $options;
    public string $label;
    public string $name;
    public $required;
    public ?string $selected;
    public function __construct(string $name, string $label, array $options, $required=null, ?string $selected = null)
    {
        $this->options = $options;
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input-select');
    }
}
