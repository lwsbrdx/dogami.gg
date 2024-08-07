<?php

namespace App\Console\Commands;

use App\Classes\Dogami\Attribute\DogamiSkill;
use App\Classes\Dogami\ObjectEnums\DogamiSkillEnum;
use App\Models\DogamisRank;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        $toDelete = DogamisRank::where('value_type', DogamisRank::MAX_VALUE)->delete();
        unset($toDelete);

        foreach (DogamiSkillEnum::all() as $skill) {
            $results = $this->requestDogamisBySkill($skill);

            foreach ($results as $key => $result) {
                $dogamiRank = new DogamisRank;
                $dogamiRank->ranking = $key + 1;
                $dogamiRank->ranking_type = DogamisRank::GLOBAL_RANKING;
                $dogamiRank->value_type = DogamisRank::MAX_VALUE;
                $dogamiRank->skill_type = $skill->value;
                $dogamiRank->skill_value = $result['skill_value'];
                $dogamiRank->dogamis = $result['dogamis'];

                $dogamiRank->save();
            }
        }
    }

    private function requestDogamisBySkill(DogamiSkillEnum $skill)
    {

        $skillLabel = $skill->label;

        $aggregate = [
            ['$unwind' => '$datas.attributes'],
            ['$match' => ['datas.attributes.trait_type' => ['$in' => ["$skill->label", 'Breed']]]],
            ['$group' => ['_id' => '$nftId', 'attributes' => ['$push' => '$datas.attributes']]],
            [
                '$project' => [
                    '_id' => 0,
                    'nftId' => '$_id',
                    'breed' => ['$arrayElemAt' => [['$map' => ['input' => '$attributes', 'as' => 'attr', 'in' => ['$cond' => ['if' => ['$eq' => ['$$attr.trait_type', 'Breed']], 'then' => '$$attr.value', 'else' => null]]]], 0]],
                    'max_value' => ['$arrayElemAt' => [['$map' => ['input' => '$attributes', 'as' => 'attr', 'in' => ['$cond' => ['if' => ['$eq' => ['$$attr.trait_type', "$skillLabel"]], 'then' => '$$attr.max_value', 'else' => null]]]], 1]]
                ]
            ],
            ['$group' => ['_id' => ['$add' => ['$max_value', DogamiSkill::MAX_BONUS]], 'dogamis' => ['$push' => ['id' => '$nftId', 'breed' => '$breed']]]],
            ['$sort' => ['_id' => -1]],
            ['$project' => ['value_type' => 'max', 'skill_type' => "$skill->value", 'skill_value' => '$_id', 'dogamis' => 1]]
        ];



        return DB::collection('dogamis')->raw(function ($collection) use ($aggregate) {
            return $collection->aggregate($aggregate);
        });
    }
}
