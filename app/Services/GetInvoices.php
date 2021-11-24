<?php

namespace App\Services;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Http;

class GetInvoices
{

    // public function execute($token)
    // {
    //     // $today = date('Y-m-d');
    //     $now = new DateTime('now', new DateTimeZone('America/Bogota'));
    //     $today = $now->format('Y-m-d');
    //     $response = Http::withHeaders([
    //         'Content-Type' => 'application/json',
    //         'Authorization' => $token
    //     ])->get(env('URL_API_SIIGO').'v1/invoices', [
    //         'created_start' => $today,
    //         'page_size' => 100
    //     ]);
    //     return $response;
    // }

    public function execute($token, $pageSize = 100)
    {
        // $today = date('Y-m-d');
        $now = new DateTime('now', new DateTimeZone('America/Bogota'));
        $today = $now->format('Y-m-d');
        $response = $this->getInvoices($token, $today, $pageSize, 1);
        $pages = ceil($response['pagination']['total_results'] / $pageSize);
        $results = $response['results'];
        for ($i = 2; $i <= $pages; $i++) {
            $newResponse = $this->getInvoices($token, $today, $pageSize, $i);
            $results = array_merge($results, $newResponse['results']);
        }
        return $results;
    }

    private function getInvoices($token, $now, $pageSize, $page)
    {
        $response = Http::withHeaders([ 
            'Content-Type' => 'application/json',
            'Authorization' => $token
        ])->get(env('URL_API_SIIGO') . 'v1/invoices', [
            'created_start' => $now,
            'page_size' => $pageSize,
            'page' =>$page
        ]);
        return $response;
    }
}

  

