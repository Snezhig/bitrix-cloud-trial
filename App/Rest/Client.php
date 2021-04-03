<?php

namespace XS\BX24\Trial\Rest;


use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;

class Client
{
    private static $instance;
    private GuzzleClient $client;

    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self(new GuzzleClient([
                'base_uri' => sprintf('https://%s/rest/%s/%s/',
                    getenv('BITRIX_URL'),
                    getenv('BITRIX_KEY_USER_ID'),
                    getenv('BITRIX_KEY'),
                )
            ]));
        }
        return self::$instance;
    }

    public function profile()
    {
        return $this->call('profile');
    }

    public function call($method, $params = []): iResponse
    {
        return new Response(
            $this->client,
            new Request('POST', $this->client->getConfig('base_uri')->__toString() . $method),
            [RequestOptions::JSON => $params]
        );
    }

}