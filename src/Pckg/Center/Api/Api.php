<?php namespace Pckg\Center\Api;

use GuzzleHttp\RequestOptions;
use Pckg\Api\Api as PckgApi;
use Pckg\Center\Api\Endpoint\Client;
use Pckg\Center\Api\Endpoint\Platform;

/**
 * Class Api
 *
 * @package Pckg\Center\Api
 */
class Api extends PckgApi
{

    /**
     * Api constructor.
     *
     * @param $endpoint
     * @param $apiKey
     */
    public function __construct(?string $endpoint, ?string $apiKey)
    {
        $this->endpoint = $endpoint;
        $this->apiKey = $apiKey;

        $this->requestOptions = [
            RequestOptions::HEADERS => [
                'X-Center-Api-Key' => $this->apiKey,
            ],
            RequestOptions::TIMEOUT => 15,
            RequestOptions::VERIFY => false,
        ];
    }

    /**
     * @return Client
     */
    public function client()
    {
        return new Client($this);
    }

    /**
     * @return Platform
     */
    public function platform()
    {
        return new Platform($this);
    }

}
