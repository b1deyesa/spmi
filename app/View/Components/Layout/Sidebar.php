<?php

namespace App\View\Components\Layout;

use App\Models\Fakultas;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $fakultas = null
    )
    {   
        $this->fakultas = Auth::user()->fakultases->first()->id ?? Fakultas::first()->id ?? 1;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.sidebar');
    }
}
