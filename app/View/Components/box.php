<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class box extends Component
{
    /**
     * Create a new component instance.
     */
    public $source;
    public $title;
    public function __construct($source,$title)
    {
        //
        $this->source=$source;
        $this->title=$title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.box');
    }
}
