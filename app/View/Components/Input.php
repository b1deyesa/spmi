<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $label = false,
        public $class = null,
        public $type = 'text',
        public $id = false,
        public $name = false,
        public $wire = false,
        public $required = false,
        public $value = false,
        public $placeholder = false,
        public $options = false,
        public $disabled = false,
        public $cols = false,
        public $rows = false,
    )
    {        
        $this->label = $label;
        $this->class = $class;
        $this->wire = $wire;
        $this->type = $type;
        $this->value = $value;
        $this->name = $name ? $name : $this->wire;
        $this->id = $id ? $id : $this->name;
        $this->placeholder = $placeholder;
        $this->options = json_decode($options, true);
        $this->disabled = $disabled;
        $this->cols = $cols;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
