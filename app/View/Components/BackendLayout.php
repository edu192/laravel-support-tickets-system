<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BackendLayout extends Component
{
    public function render()
    : View
    {
        return view('layouts.backend-layout');
    }
}
