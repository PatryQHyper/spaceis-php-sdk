<?php

namespace PatryQHyper\SpaceIs;

use GuzzleHttp\Client;
use PatryQHyper\SpaceIs\Exceptions\LicenseExpiredException;
use PatryQHyper\SpaceIs\Exceptions\NotFoundException;
use PatryQHyper\SpaceIs\Exceptions\RateLimitException;
use PatryQHyper\SpaceIs\Exceptions\ServerErrorException;
use PatryQHyper\SpaceIs\Exceptions\UnauthorizedException;

/**
 * Created with love by: PatryQHyper.pl
 * Date: 28.11.2021 22:47
 * Using: PhpStorm
 */
class SpaceIs extends Servers
{
    protected string $apiKey;
    protected string $apiUrl;

    public function __construct(string $apiKey, string $apiUrl = 'https://api.spaceis.pl/v3')
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }

    protected function doRequest($url, $data = [], $method = 'GET', bool $getBody = true, bool $exceptionOnNotFound = true)
    {
        $method = strtoupper($method);

        $client = new Client();
        try {
            $data['headers']['User-Agent'] = 'SpaceIsSDK/1.0.0';
            $data['headers']['Accept'] = 'application/json';
            $data['headers']['Authorization'] = 'Bearer ' . $this->apiKey;

            $response = $client->request($method, $this->apiUrl . $url, $data);

            if ($getBody) return json_decode($response->getBody())->data;

        } catch (\Exception $e) {
            $response = $e->getResponse();
            switch ($response->getStatusCode()) {
                case 402:
                    throw new LicenseExpiredException('License expired');
                    break;
                case 401:
                    throw new UnauthorizedException('Unauthorized');
                    break;
                case 500:
                    throw new ServerErrorException('SpaceIs server error');
                    break;
                case 429:
                    throw new RateLimitException('Ratelimit reached');
                    break;
            }

            if ($response->getStatusCode() == 404 && $exceptionOnNotFound) throw new NotFoundException($response->getBody());

        }

        return $response;
    }
}