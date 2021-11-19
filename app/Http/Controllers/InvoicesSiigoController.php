<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use Illuminate\Http\Request;
use App\Services\Token;
use App\Services\GetInvoices;
use App\Services\GetInvoice;
use App\Services\GetClient;
use App\Services\SaveInvoices;
use DateTime;
use DateTimeZone;

class InvoicesSiigoController extends Controller
{
    public function __construct(Token $token, GetInvoices $getInvoices, GetInvoice $getInvoice, GetClient $getClient, SaveInvoices $saveInvoices)
    {
        $this->token = $token;
        $this->getInvoices = $getInvoices;
        $this->getInvoice = $getInvoice;
        $this->getClient = $getClient;
        $this->saveInvoices = $saveInvoices;
    }
    public function listInvoices()
    {
        $token = $this->token->getToken();
        $invoices = $this->getInvoices->execute($token);
        return $invoices;
    }

    public function saveInvoices()
    {
        $invoices = $this->listInvoices();
        // return $invoices;
        $save = $this->saveInvoices->execute($invoices);
        if ($save) {
            return true;
        }else {
            return false;
        }
    }
}
