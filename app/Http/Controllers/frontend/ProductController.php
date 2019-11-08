<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function getShop() {
        return view('frontend.product.shop');
    }

    function getDetail() {
        return view('frontend.product.detail');
    }
}
