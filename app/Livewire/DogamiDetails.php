<?php

namespace App\Livewire;

use App\Models\Dogami;
use App\Services\DogamiService;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class DogamiDetails extends Component
{
    public Dogami $dogami;
    public bool $use_max_values;

    public function mount(?Dogami $dogami, bool $use_max_values = false)
    {
        $this->dogami = $dogami;
        $this->use_max_values = $use_max_values;
    }

    public function render()
    {
        return view('livewire.dogami-details');
    }

    public function update(DogamiService $dogamiService)
    {
        $this->dogami = $dogamiService->fetchDogami($this->dogami->nftId);
        $this->dogami->save();

        Artisan::call('dogamis:skills:rankings:actual');
        Artisan::call('dogamis:skills:rankings:max');
    }

    public function toggleUseMax() {
        $this->use_max_values = !$this->use_max_values;
    }
}
