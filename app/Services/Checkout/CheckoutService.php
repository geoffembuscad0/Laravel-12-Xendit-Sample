<?php
namespace app\Http\Services\Checkout;

use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\InvoiceClient; // or however the client is imported in new version
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;

class CheckoutService {

    function __construct() {
        Configuration::setXenditKey(env('API_KEY'));
    }

    public function createInvoice($args) {
        $date = new \DateTime();
        $redirectUrl = '';
        $defParams = [
            'external_id' => 'lar8-checkout-demo-' . $date->getTimestamp(),
            'payer_email' => 'invoice+demo@xendit.co',
            'description' => 'Laravel 8 Checkout Demo',
            'failure_redirect_url' => $redirectUrl,
            'success_redirect_url' => $redirectUrl
        ];

        $data = json_decode(json_encode($args), true);
        $defParams['failure_redirect_url'] = $data['redirect_url'];
        $defParams['success_redirect_url'] = $data['redirect_url'];
        $params = array_merge($defParams, $data);
        $response = [];
        $invoiceInstance = new InvoiceApi();
        $create_invoice_request = new CreateInvoiceRequest([
            'external_id' => 'test1234',
            'description' => 'Test Invoice',
            'amount' => 10000,
            'invoice_duration' => 172800,
            'currency' => 'IDR',
            'reminder_time' => 1
        ]);
        $for_user_id = "62efe4c33e45694d63f585f0";
        try {
            $result = $invoiceInstance->createInvoice($create_invoice_request, $for_user_id);
        } catch (\Throwable $e) {
            $response['message'] = $e->getMessage();
        }

        logger($response);
        return $response;
    }
}
