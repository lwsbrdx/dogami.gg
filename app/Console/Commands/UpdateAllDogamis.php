<?php

namespace App\Console\Commands;

use App\Services\DogamiService;
use Illuminate\Console\Command;

class UpdateAllDogamis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dogamis:update:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dogamiService = new DogamiService;
        $max_dogamis = $dogamiService->count();

        for ($id = 1; $id <= $max_dogamis; $id++) {
            $dogami = $dogamiService->fetchDogami($id);
            $dogami->save();

            if ($id % 500 === 0) {
                dump("#$id");
            }
        }

        dump("All DOGAMIs updated");

        $this->call('dogamis:skills:rankings:actual');
        $this->call('dogamis:skills:rankings:max');
    }
}
