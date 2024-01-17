<?php

namespace App\Services;

use App\Models\Dogami;
use App\Classes\Dogami\Http\DogamiClient;
use GuzzleHttp\Client as GuzzleHttpClient;

class DogamiService {

    public DogamiClient $dogamiClient;

    public function __construct()
    {
        $this->dogamiClient = new DogamiClient();
    }

    public function fetchDogami(int $id): Dogami
    {
        $response = $this->dogamiClient
            ->path('/metadata/dogami/ids/:id')
            ->attr(['id' => $id])
            ->execute();

        $dogamiJsonDecoded = json_decode(
            $response->getBody()->getContents(),
            true,
        )[0] ?? [];

        return Dogami::fromMap($dogamiJsonDecoded);
    }

    public function count()
    {
        $dogami_contract = 'KT1NVvPsNDChrLRH5K2cy6Sc9r1uuUwdiZQd';
        $client = new GuzzleHttpClient([
            'base_uri' => 'https://api.tzkt.io'
        ]);

        $response = $client->get("/v1/tokens/count?contract=$dogami_contract");
        return (int) $response->getBody()->getContents();
    }
}
