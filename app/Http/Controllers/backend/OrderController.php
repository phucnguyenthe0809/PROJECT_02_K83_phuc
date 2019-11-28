<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Order;
class OrderController extends Controller
{
    function getOrder() {
        $data['order']=Order::where('state',2)->orderBy('updated_at','desc')->get();
        return view('backend.order.order',$data);
    }
    function getDetail() {
        return view('backend.order.detailorder');
    }
    function getProcessed() {
        $data['order']=Order::where('state',1)->orderBy('updated_at','desc')->get();
        return view('backend.order.processed',$data);
    }
}
