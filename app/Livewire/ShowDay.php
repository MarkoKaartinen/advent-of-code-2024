<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class ShowDay extends Component
{
    public $dayNumber;

    public function mount($day)
    {
        $this->dayNumber = $day;
    }

    public function render()
    {
        return view('livewire.show-day');
    }

    #[Computed]
    public function day()
    {
        $class = 'App\Days\Day'.$this->dayNumber;
        return new $class;
    }

}
