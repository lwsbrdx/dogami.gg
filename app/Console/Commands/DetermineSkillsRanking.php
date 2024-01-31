<?php

namespace App\Console\Commands;

use App\Classes\Dogami\Attribute\DogamiSkill;
use App\Models\Dogami;
use App\Models\DogamisRank;
use Illuminate\Console\Command;

class DetermineSkillsRanking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dogamis:skills:rankings';

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
        ini_set('memory_limit', '512M');
        DogamisRank::truncate();
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
                $values[$dogamiSkill->bonused_value] = [
                    'dogamis' => [
                        ...($values[$dogamiSkill->bonused_value]['dogamis'] ?? []),
                        [
                            "id" => $dogami->nftId,
                            "breed" => $dogami->breed->name,
                        ]
                    ]
                ];

                $max_values[$dogamiSkill->max_bonused_value] = [
                    'dogamis' => [
                        ...($values[$dogamiSkill->max_bonused_value]['dogamis'] ?? []),
                        [
                            "id" => $dogami->nftId,
                            "breed" => $dogami->breed->name,
                        ]
                    ]
                ];
            }
            // 1. b) Trier par valeur de la compétence, du plus grand au plus petit
            krsort($values);
            krsort($max_values);

            // 2. Création des rankings à mettre en bdd
            $i = 1;
            foreach ($values as $skill_value => $value) {
                $dogamiRank = new DogamisRank;
                $dogamiRank->ranking = $i;
                $dogamiRank->value_type = DogamisRank::ACTUAL_VALUE;
                $dogamiRank->skill_type = $skill;
                $dogamiRank->skill_value = $skill_value;
                $dogamiRank->dogamis = $value['dogamis'];

                $dogamiRank->save();

                $i++;
            }
            // plus besoin de ce tableau, on vide la mémoire
            unset($values);

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
            unset($max_values);
        }
    }
}
