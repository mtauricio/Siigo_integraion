<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Token 
{

    public function getToken()
    {
        $response = Http::post(env('URL_API_SIIGO').'auth', [
            'username' => env('SIIGO_USERNAME'),
            'access_key' => env('SIIGO_ACCESS_KEY'),
        ]);
        return $response['access_token'];
    }

  
}
