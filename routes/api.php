<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GithubApiController;

Route::get('/user/{username}', [GithubApiController::class, 'getUserAndFollowing']);

Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});
