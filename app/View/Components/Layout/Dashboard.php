<?php

namespace App\View\Components\Layout;

use App\Models\Fakultas;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dashboard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Fakultas $fakultas
    )
    {
        $this->fakultas = $fakultas;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.dashboard');
    }
}
