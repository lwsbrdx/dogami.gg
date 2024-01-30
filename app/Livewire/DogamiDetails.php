<?php

namespace App\Livewire;

use App\Models\Dogami;
use App\Services\DogamiService;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class DogamiDetails extends Component
{
    public Dogami $dogami;

    public function mount(?Dogami $dogami)
    {
        $this->dogami = $dogami;
    }

    public function render()
    {
        return view('livewire.dogami-details');
    }

    public function update(DogamiService $dogamiService)
    {
        $this->dogami = $dogamiService->fetchDogami($this->dogami->nftId);
        $this->dogami->save();

        Artisan::call('dogamis:skills:rankings');
    }
}
