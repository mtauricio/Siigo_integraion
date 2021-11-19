<?php

namespace App\Services;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Http;

class TestServiceSQ 
{

    public function execute($token)
    {
        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'Accept' => 'application/json',
        //     'ApiKey' => env('API_KEY_SQ'),
        //     'Event' => 'depots.list'
        // ])->get(env('URL_API_SQ'), [
        //     // 'data' => [$data],
        // ]);
        // return $response;
$now = new DateTime('now', new DateTimeZone('America/Bogota'));
        $today = $now->format('Y-m-d');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            // 'Accept' => 'application/json',
            // 'ApiKey' => env('API_KEY_SQ'),
            // 'Event' => 'depots.list'
            'Authorization' => $token
        ])->get('https://api.siigo.com/v1/credit-notes', [
            // 'data' => [$data],
            // 'created_start' => $today
        ]);
        return $response;
    }

  
}
