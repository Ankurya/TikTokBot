<?php

namespace App\Services;

use App\Models\Api;
use App\Models\User;
use App\Enums\ApiType;
use GuzzleHttp\Client;
use App\Models\Account;
use App\Enums\EntityEnums;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TikApiService
{
    /**
     * Declare common code to be used accross
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = Api::platform('TikApi')->first()->api_key;
    }

    /**
     * This is a TikApi redirect which fetches the
     * access_token to be used as ACCOUNT KEY in
     * Private API calls
     * 
     * @param Array $request($access_token, scope)
     * @return Redirect
     */
    public function getAccountKey($request)
    {
        try {
            if (isset($request['access_token'])) {
                Account::create([
                    'user_id'     => (int)$request['state'],
                    'account_key' => $request['access_token']
                ]);

                return redirect()->route(EntityEnums::DASHBOARD);
            }

            return redirect(EntityEnums::ACCOUNTS);
        } catch (\Exception $e) {
            echo '<pre>';
            print_r($e);
            die;
        }
    }

    /**
     * Creates GET type API calls headers
     * 
     * @param Array $request
     * @return Array $request
     */
    private function getApi($request)
    {
        $request['headers'] = [
            'X-API-KEY' => $this->apiKey,
            'accept'    => 'application/json'
        ];

        if (isset($request['api_type']) && $request['api_type'] == ApiType::PRIVATE_API)
            $request['headers']['X-ACCOUNT-KEY'] = Auth::user()->accounts->first()->account_key;

        return $request;
    }

    /**
     * Creates POST type API calls headers
     * 
     * @param Array $request
     * @return Array $request
     */
    private function postApi($request)
    {
        $request['headers'] = [
            'X-ACCOUNT-KEY' => Auth::user()->accounts->first()->account_key,
            'X-API-KEY'     => $this->apiKey,
            'accept'        => 'application/json',
            'content-type'  => 'application/json'
        ];

        return $request;
    }

    /**
     * This function will hit the POST TikApi endpoint
     * 
     * @param Array $request($type, $endpoint)
     * @return Object
     */
    private function tikApi($request = null)
    {
        try {
            if ($request['request_type'] == 'POST') {
                $apiData = $this->postApi($request);

                $response = $this->client->request(
                    $apiData['request_type'],
                    $apiData['endpoint_url'],
                    [
                        'headers' => $apiData['headers'],
                        'json'    => $apiData['json']
                    ]
                );
            } else if ($request['request_type'] == 'GET') {
                $apiData = $this->getApi($request);

                $response = $this->client->request(
                    $apiData['request_type'],
                    $apiData['endpoint_url'],
                    [
                        'headers' => $apiData['headers']
                    ]
                )->getBody()->getContents();
            }

            return $response;
        } catch (\Exception $e) {
            echo '<pre>';
            print_r($e);
            die;
        }
    }

    /**
     * Get user info
     * 
     * @return Response
     */
    public function getUserInfo()
    { 
        return self::tikApi([
            'api_type'      => ApiType::PRIVATE_API,
            'request_type'  => 'GET',
            'endpoint_url'  => 'https://api.tikapi.io/user/info'
        ]);
    }

    /**
     * Find user by username
     * 
     * @param String $request
     * @return Response
     */
    public function findUsername($request)
    {
        return self::tikApi([
            'request_type'  => 'GET',
            'endpoint_url'  => 'https://api.tikapi.io/public/check?username='.$request
        ]);
    }

    /**
     * Find hashtag by hashtag name
     * 
     * @param String $request
     * @return Response
     */
    public function findHashtag($request)
    {
        return self::tikApi([
            'request_type'  => 'GET',
            'endpoint_url'  => 'https://api.tikapi.io/public/hashtag?name='.$request
        ]);
    }

    /**
     * Follows an user
     * 
     * @param Array $request
     * @return Response
     */
    public function followUser($request)
    {
        return self::tikApi([
            'request_type'  => 'POST',
            'endpoint_url'  => 'https://api.tikapi.io/user/follow',
            'json'          => [
                'username' => $request['username'],
                'user_id'  => $request['user_id'],
            ]
        ]);
    }
}