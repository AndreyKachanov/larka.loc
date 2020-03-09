<?php


namespace App\Services;


use GuzzleHttp\Client;

class GuzzleService
{
    /**
     * @var Client
     */
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
