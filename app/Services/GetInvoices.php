<?php

namespace App\Services;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Http;

class GetInvoices
{

    public function execute($token)
    {
        // $today = date('Y-m-d');
        $now = new DateTime('now', new DateTimeZone('America/Bogota'));
        $today = $now->format('Y-m-d');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $token
        ])->get(env('URL_API_SIIGO').'v1/invoices', [
            'created_start' => '2021-11-18'
        ]);
        return $response;
    }

  
}
