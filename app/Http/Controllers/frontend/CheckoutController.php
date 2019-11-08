<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    function getCheckout() {
        return view('frontend.checkout.checkout');
    }

    function getComplete() {
        return view('frontend.checkout.complete');
    }
}
