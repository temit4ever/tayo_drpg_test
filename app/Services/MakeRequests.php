<?php

namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Create API request class implementation
 *
 */
class MakeRequests
{
    protected $base_url;
    protected $http;

    public function __construct(Client $client)
    {
        $this->base_url = env('API_URL');
        $this->http = $client;
    }

    /**
     *
     * @return array/string
     * @throws GuzzleException
     */
    public function getResponse(): array
    {
        $request = $this->http->request('GET', $this->base_url);
        $response = $request->getBody();
        if ($request->getStatusCode() != 200) return $request->getReasonPhrase();

        return json_decode($response, true);
    }

}
