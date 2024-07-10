<?php

namespace App\Http\Controllers\Api;

use App\Services\GitHubService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Log;

class GitHubApiController extends Controller
{
    protected $githubService;

    use Log;

    public function __construct(GitHubService $githubService) 
    {
        $this->githubService = $githubService;
    }

    public function getUserAndFollowing($username)
    {
        $data = $this->githubService->getUserAndFollowing($username);
        $followingLogin = array();

        if (!isset($data['error'])) {
            foreach ($data['following'] as $following) {
                array_push($followingLogin, $following['login']);
            }
    
            $this->Log($data['user']['login'], $followingLogin);  
        } else {
            $this->Log($username, $data['error']);  
        }

        return response()->json($data);
    }
}
