<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Xendit\Xendit;

class CheckoutController extends Controller
{
    //
    public function index() {
        return View::make("v1/checkout/checkout");
    }


    public function onSubmit() {
        return View::make("v1/checkout/try-checkout");
    }
}
