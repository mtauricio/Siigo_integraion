<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CreateServiceSQ 
{

    public function execute($data)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'ApiKey' => env('API_KEY_SQ'),
            'Event' => 'service.creation'
        ])->post(env('URL_API_SQ'), [
            'data' => [$data],
        ]);
        return $response;
    }

  
}
