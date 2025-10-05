<?php
namespace app\Http\Services\Checkout;

use Xendit\InvoiceClient; // or however the client is imported in new version
use Xendit\Configuration;

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

        try {
            $response = InvoiceXendit::createInvoice($params);
        } catch (\Throwable $e) {
            $response['message'] = $e->getMessage();
        }

        logger($response);
        return $response;
    }
}
