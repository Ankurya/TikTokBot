<?php

namespace App\Http\Controllers\Open;

use GuzzleHttp\Client;
use App\Enums\TargetType;
use Illuminate\Http\Request;
use App\Services\TikApiService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ApiController extends Controller
{
    /**
     * Declare common code to be used accross
     */
    public function __construct()
    {
        $this->tikApiService = new TikApiService();
    }

    /**
     * Fetch account key i.e. access token
     * 
     * @param Illuminate\Http\Request $request
     * @return Response
     */
    public function getAccountKey(Request $request)
    {
        return $this->tikApiService->getAccountKey($request->all());
    }

    /**
     * Get user info
     * 
     * @return Response
     */
    public function getUserInfo()
    {
        echo '<pre>';
        print_r(json_decode($this->tikApiService->getUserInfo())->userInfo);
        die;

        // return $this->tikApiService->getUserInfo();
    }

    /**
     * Find target
     * 
     * @param Illuminate\Http\Request $request
     * @return Response
     */
    public function findUsername($entity)
    {
        echo '<pre>';
        print_r(json_decode($this->tikApiService->findUsername($entity))->userInfo);
        die;  

        // return $this->tikApiService->findUsername($entity);  
    }

    /**
     * Find hashtag
     * 
     * @param Illuminate\Http\Request $request
     * @return Response
     */
    public function findHashtag($entity)
    {
        echo '<pre>';
        print_r(json_decode($this->tikApiService->findHashtag($entity))->itemList);
        die;  

        // return $this->tikApiService->findUsername($entity);  
    }

    /**
     * Follows an user
     * 
     * @param Illuminate\Http\Request $request
     * @return Response
     */
    public function followUser($entity)
    {
        $user = json_decode($this->tikApiService->findUsername($entity));

        $api = $this->tikApiService->followUser([
            'username'  => $entity,
            'user_id'   => (int)$user->userInfo->user->id
        ]);
    }
}
