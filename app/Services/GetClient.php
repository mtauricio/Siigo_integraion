<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GetClient
{

    public function execute($token,$id_customer)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $token
        ])->get(env('URL_API_SIIGO').'v1/customers/'.$id_customer, [
            // 'invoice_id' => $id_invoice
        ]);
        // echo $id_invoice;
        return $response;
    }

  
}
