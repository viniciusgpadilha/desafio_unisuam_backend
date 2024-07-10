<?php

namespace App\Http\Traits;

use DB;

trait Log {
    public function Log($request,$response) 
        { 
            DB::table('logs')->insert([
                [ 
                    'request' => $request,
                    'response' => json_encode($response, JSON_UNESCAPED_UNICODE),
                ]
            ]);
        }
    }