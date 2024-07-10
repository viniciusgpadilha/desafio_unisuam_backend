<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Arr;

class GitHubService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.github.com/',
            'headers' => [
                'Authorization' => 'token ' . config('services.github.token'),
                'Accept' => 'application/vnd.github.v3+json',
            ],
        ]);
    }

    public function getUserAndFollowing($username)
    {
        try {
            $userResponse = $this->client->get("users/{$username}");
            $userData = json_decode($userResponse->getBody()->getContents(), true);
    
            $followingResponse = $this->client->get("users/{$username}/following");
            $followingData = json_decode($followingResponse->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() == 404) {
                return [
                    'error' => 'Usuário não encontrado',
                ];
            }
        }
        
        return [
            'user' => $userData,
            'following' => $followingData,
        ];
    }
}
