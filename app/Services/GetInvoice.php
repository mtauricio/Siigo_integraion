<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GetInvoice
{

    public function execute($token,$id_invoice)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $token
        ])->get(env('URL_API_SIIGO').'v1/invoices/'.$id_invoice, [
            // 'invoice_id' => $id_invoice
        ]);
        // echo $id_invoice;
        return $response;
    }

  
}
