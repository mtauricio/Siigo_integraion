<?php

namespace App\Services;

use App\Models\Invoices;
use Illuminate\Support\Facades\Http;

class GetInvoicesBD
{

    public function execute()
    {
        $invoiceInBd = Invoices::where('status', '=', false)->take(4)->get();
        return $invoiceInBd;
    }

  
}
