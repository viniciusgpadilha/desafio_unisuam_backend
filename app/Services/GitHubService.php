<?php

namespace App\Services;

use GuzzleHttp\Client;
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
        $userResponse = $this->client->get("users/{$username}");
        $userData = json_decode($userResponse->getBody()->getContents(), true);

        $followingResponse = $this->client->get("users/{$username}/following");
        $followingData = json_decode($followingResponse->getBody()->getContents(), true);

        return [
            'user' => $userData,
            'following' => $followingData,
        ];
    }
}
