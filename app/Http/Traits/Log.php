<?php

namespace App\Http\Traits;

use DB;

trait Log {
    public function Log($username,$following) 
        { 
            DB::table('logs')->insert([
                [ 
                    'username' => $username,
                    'following' => json_encode($following, JSON_UNESCAPED_UNICODE),
                ]
            ]);
        }
    }