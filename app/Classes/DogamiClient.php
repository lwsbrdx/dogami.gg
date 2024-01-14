<?php

namespace App\Classes;

use App\Enums\HttpMethod;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Psr7\Request;

class DogamiClient {
    private GuzzleHttpClient $client;
    private HttpMethod $method = HttpMethod::GET;
    private array $attributes = [];
    private string $uri = '';

    public function __construct() {
        $this->client = new GuzzleHttpClient([
            'base_uri' => 'https://proxy.dogami.com'
        ]);
    }

    public function path(string $uri) {
        $this->uri = $uri;
        return $this;
    }

    public function attr(array $attributes) {
        $this->attributes = $attributes;
        return $this;
    }

    public function execute() {
        foreach ($this->attributes as $key => $attribute) {
            $this->uri = str_replace(":$key", $attribute, $this->uri);
        }

        $request = new Request(
            $this->method->value,
            $this->uri,
        );

        return $this->client->send($request);
    }
}
