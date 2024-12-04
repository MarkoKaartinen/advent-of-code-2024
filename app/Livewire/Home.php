<?php

namespace App\Livewire;

use Illuminate\Filesystem\Filesystem;
use Livewire\Component;

class Home extends Component
{
    public $days;

    public function mount()
    {
        $this->days = $this->getDays();
    }

    public function render()
    {
        return view('livewire.home');
    }

    public function getDays(): array
    {
        $filesystem = new Filesystem;
        $files = $filesystem->files(base_path('app/Days'));
        $days = [];
        foreach ($files as $file) {
            $days[] = str_replace('Day', '', $file->getFilenameWithoutExtension());
        }

        return $days;
    }
}
