<?php

namespace App\Console\Commands;

use App\Classes\Dogami\Attribute\DogamiSkill;
use App\Models\Dogami;
use App\Models\DogamisRank;
use Illuminate\Console\Command;

class DetermineMaxSkillsRanking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dogamis:skills:rankings:max';

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
        ini_set('memory_limit', '1G');

        $toDelete = DogamisRank::where('value_type', DogamisRank::MAX_VALUE)->delete();
        unset($toDelete);

        $dogamis = Dogami::all();

        foreach(DogamiSkill::SKILLS as $skill)
        {
            // 1. Trier les chiens par niveau de la compétence
            // 1. a) Ceux qui ont la même valeur ensemble
            $values = [];
            foreach ($dogamis as $dogami)
            {
                if ($dogami->isBox) continue;

                /** @var DogamiSkill $dogamiSkill */
                $dogamiSkill = $dogami->$skill;

                $max_values[$dogamiSkill->max_bonused_value] = [
                    'dogamis' => [
                        ...($max_values[$dogamiSkill->max_bonused_value]['dogamis'] ?? []),
                        [
                            "id" => $dogami->nftId,
                            "breed" => $dogami->breed->name,
                        ]
                    ]
                ];
            }
            // 1. b) Trier par valeur de la compétence, du plus grand au plus petit
            krsort($max_values);

            // 2. Création des rankings à mettre en bdd
            $i = 1;
            foreach ($max_values as $skill_value => $value) {
                $dogamiRank = new DogamisRank;
                $dogamiRank->ranking = $i;
                $dogamiRank->value_type = DogamisRank::MAX_VALUE;
                $dogamiRank->skill_type = $skill;
                $dogamiRank->skill_value = $skill_value;
                $dogamiRank->dogamis = $value['dogamis'];

                $dogamiRank->save();

                $i++;
            }
            // plus besoin de ce tableau, on vide la mémoire
            unset($max_values);
        }
    }
}
