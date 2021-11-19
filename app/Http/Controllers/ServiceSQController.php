<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use Illuminate\Http\Request;
use App\Services\GetInvoicesBD;
use App\Services\GetInvoice;
use App\Services\GetClient;
use App\Services\Token;
use App\Services\CreateServiceSQ;
use App\Services\TestServiceSQ;
use DateTime;
use DateTimeZone;

class ServiceSQController extends Controller
{

    public function __construct(GetInvoicesBD $getInvoicesBD, GetInvoice $getInvoice, GetClient $getClient, Token $token, CreateServiceSQ $createServiceSQ)
    {
        $this->getInvoicesBD = $getInvoicesBD;
        $this->token = $token;
        $this->getInvoice = $getInvoice;
        $this->getClient = $getClient;
        $this->createServiceSQ = $createServiceSQ;
    }

    public function createService()
    {
        $token = $this->token->getToken();
        $now = new DateTime('now', new DateTimeZone('America/Bogota'));
        $today = $now->format('Y-m-d H:i:s');
         $invoicesBD = $this->getInvoicesBD->execute();
        $faileds = 0;
         foreach ($invoicesBD as $invoiceBD) {
            // var_dump('<pre>'.$invoiceBD['id_siigo']);
            $invoice = $this->getInvoice->execute($token,$invoiceBD['id_siigo']);
            // var_dump('<pre>'.$invoice);
            $customer_id = $invoice['customer']['id'];
            $client = $this->getClient->execute($token,$customer_id);
            // var_dump('<pre>'.$client);
            $data = $this->datesForService($client,$invoice);

                // return json_encode($data);
                $response = $this->createServiceSQ->execute($data);
            if ($response['success'] == 1 && $response['errors']['n_errors'] == 0) {
                $invoiceToUpdate = Invoices::FindOrFail($invoiceBD['id']);
                $invoiceToUpdate->status = true;
                $invoiceToUpdate->date_service = $today;
                $invoiceToUpdate->id_service = $response['services_success'][0]['system_id'];
                $invoiceToUpdate->save();
            }else{
                $faileds++;
            }
            
         }
         return $faileds;

    }
    public function datesForService( $client, $invoice)
    {
        $now = new DateTime('now', new DateTimeZone('America/Bogota'));
        $today = $now->format('Y-m-d');
        $tumorrow = date("Y-m-d",strtotime($today."+ 1 days")); 
        // $products = [];
        // foreach ($invoice['items'] as $item) {
        //     $products[] = [ "product_sku" => $item['code'],
        //                     "product_name" =>  $item['description'],
        //                     "product_description" =>  $item['description'],
        //                     "product_weight" => 1,
        //                     "service_quantity" => $item['quantity']];
        // }
        $name = '';
        foreach ($client['name'] as $key) {
            $name .= $key." ";
        }
        // $name = json_encode($client['name']);
        $data = [
            "client_name" => $name,
            // "client_email" => $client['contacts'][0]['email'],
            "client_email" => 'correo@prueba.com',
            // "client_document_type" => 0,
            "client_document" => $client['identification'],
            "client_phone_number" => $client['phones'][0]['number'],
            "client_address" =>  $client['address']['address'],
            "city" => $client['address']['city']['city_code'],
            "hour" => "08:00",
            "date" => $tumorrow ,
            // "load_time" => 0,
            "start_time_delivery" => "08:00",
            "end_time_delivery" => "18:00",
            
            "service_order" => $invoice['name'],
            "type_service" => [
                "1"
                ],
            "depot" => "1",
            "weight" => "1",
            "delivery_address" => $client['address']['address'],
            "longitude" => "0.00",
            "latitude" => "0.00",
      
            ];
            return $data;
    }
}
