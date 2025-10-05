<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Checkout\CheckoutService as Service;

class CheckoutApiController extends Controller
{
    //
    public function create(Request $request){
        $service = new Service();

        return $service->createInvoice($request->all());

    }
}
