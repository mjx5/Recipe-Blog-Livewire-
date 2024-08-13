<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavLink extends Component
{
    public $href;
    public $isActive;
    public $text;

    public function __construct($href, $isActive = false, $text = '')
    {
        $this->href = $href;
        $this->isActive = $isActive;
        $this->text = $text;
    }

    public function render()
    {
        return view('components.nav-link');
    }
}
