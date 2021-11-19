<?php

namespace App\Services;

use App\Models\Invoices;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Http;

class SaveInvoices 
{
public function execute($invoices)
{
    // $invoices = $this->listInvoices();
    try {
        foreach ($invoices['results'] as $invoicesiigo) {
            $invoiceInBd = Invoices::where('id_siigo', '=', $invoicesiigo['id'])->get();
            // var_dump('<pre>'.$invoiceInBd);
            if($invoiceInBd == '[]'){
                $invoice = new Invoices;
                $invoice->id_siigo = $invoicesiigo['id'];
                $invoice->number = $invoicesiigo['number'];
                $invoice->name = $invoicesiigo['name'];
                $invoice->total = $invoicesiigo['total'];
                $invoice->status = false;
                $invoice->save();
            } 
        }
    } catch (\Exception $e) {
        return $e->getMessage();
    }
    return true;
    
  
}
}