<?php

namespace App\Livewire;

use App\Models\Dogami;
use Livewire\Component;

class DogamiSkills extends Component
{
    public Dogami $dogami;

    public function render()
    {
        return view('livewire.dogami-skills');
    }
}
