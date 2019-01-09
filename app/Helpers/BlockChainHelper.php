<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Facade;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class BlockChainHelperFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'BlockChainHelper';
    }
}

class BlockChainHelper
{
    private static $client;

    public static function setupClient()
    {
        if(!self::$client)
        {
            self::$client = new Client([
                // Base URI is used with relative requests
                'base_uri' => env('BLOCKCHAIN_API'),
                'headers' => [
                    'X-User-Id'=> env('BLOCKCHAIN_USER_ID'),
                    'X-Auth-Token' => env('BLOCKCHAIN_AUTH_TOKEN')
                ]
            ]);
        }
    }

    public static function get($api)
    {
        try {
            self::setupClient();
            $response = self::$client->request('GET', $api);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public static function post($api, $params = null)
    {
        try {
            self::setupClient();
            $response = self::$client->request('POST', $api, ['form_params' => $params]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }
}