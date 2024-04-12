<?php

namespace App\Console\Commands;

use App\Classes\Dogami\Attribute\DogamiSkill;
use App\Models\Dogami;
use App\Models\DogamisRank;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DetermineSkillsRanking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dogamis:skills:rankings:actual';

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
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '768M');

        $toDelete = DogamisRank::where('value_type', DogamisRank::ACTUAL_VALUE)->delete();
        unset($toDelete);

        foreach (DogamiSkill::SKILLS as $skill) {
            $ucfSkill = ucfirst($skill);
            
            $aggregate = [
                ['$unwind' => '$datas.attributes'],
                ['$match' => ['datas.attributes.trait_type' => ['$in' => ["$ucfSkill", 'Breed']]]],
                ['$group' => ['_id' => '$nftId', 'attributes' => ['$push' => '$datas.attributes']]],
                ['$project' => ['_id' => 0, 'nftId' => '$_id', 'breed' => ['$arrayElemAt' => [['$map' => ['input' => '$attributes', 'as' => 'attr', 'in' => ['$cond' => ['if' => ['$eq' => ['$$attr.trait_type', 'Breed']], 'then' => '$$attr.value', 'else' => null]]]], 0]], 'level' => ['$arrayElemAt' => [['$map' => ['input' => '$attributes', 'as' => 'attr', 'in' => ['$cond' => ['if' => ['$eq' => ['$$attr.trait_type', "$ucfSkill"]], 'then' => '$$attr.level', 'else' => null]]]], 1]], 'bonus_level' => ['$arrayElemAt' => [['$map' => ['input' => '$attributes', 'as' => 'attr', 'in' => ['$cond' => ['if' => ['$eq' => ['$$attr.trait_type', "$ucfSkill"]], 'then' => '$$attr.bonus_level', 'else' => null]]]], 1]]]],
                ['$group' => ['_id' => ['$add' => ['$level', '$bonus_level']], 'dogamis' => ['$push' => ['id' => '$nftId', 'breed' => '$breed']]]],
                ['$sort' => ['_id' => -1]],
                ['$project' => ['value_type' => 'actual', 'skill_type' => "$skill", 'skill_value' => '$_id', 'dogamis' => 1]]
            ];

            $results = DB::collection('dogamis')->raw(function ($collection) use ($aggregate) {
                return $collection->aggregate($aggregate);
            });

            foreach ($results as $key => $result) {
                $dogamiRank = new DogamisRank;
                $dogamiRank->ranking = $key + 1;
                $dogamiRank->value_type = DogamisRank::ACTUAL_VALUE;
                $dogamiRank->skill_type = $skill;
                $dogamiRank->skill_value = $result['skill_value'];
                $dogamiRank->dogamis = $result['dogamis'];

                $dogamiRank->save();
            }
        }
    }
}
