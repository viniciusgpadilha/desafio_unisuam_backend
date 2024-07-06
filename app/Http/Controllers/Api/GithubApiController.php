<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class GithubApiController extends Controller
{
    public function getUserData($username)
    {
        $response = Http::get("https://api.github.com/users/{$username}");
        Log::info("GitHub API Request Username: " . $response->body());
        $user = $response->json();

        $response = Http::get("https://api.github.com/users/{$username}/following");
        Log::info("GitHub API Response Username Following: " . $response->body());
        $following = $response->json();

        // dd($user);

        return response()->json([
            'user' => $user,
            'following' => $following
        ]);
    }
}
