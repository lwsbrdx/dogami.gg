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
        $dogamis_count = 0;
        $dogamis_contracts = [
            '0xa3f2D95fF09ef87eb228D1Aa965e06DB4e9Ce71b', // Alpha
            '0xb953ACa746f3b4AB5C9E5A6aa9A6C986a8599Be5', // Gamma
        ];
        
        $client = new GuzzleHttpClient([
            'base_uri' => 'https://api.polygonscan.com'
        ]);

        foreach ($dogamis_contracts as $dogami_contract) {
            $response = $client->get("/api?module=stats&action=tokensupply&contractaddress=$dogami_contract&apikey=ERTJWC6J24SDUXM9HIWX2CGV28UME85BXN");
            $response_content = json_decode($response->getBody()->getContents(), true);
            $dogamis_count += $response_content['result'];
        }

        return $dogamis_count;
    }
}
