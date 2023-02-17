<?php

namespace App\View\Components;

use Haringsrob\LivewireDatepicker\Http\Livewire\DatePickerComponent;

class DataPickerComponent extends DatePickerComponent
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.data-picker-component');
    }
}
