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
    function getDetail($idOrder) {
        $data['order']=Order::find($idOrder);
        return view('backend.order.detailorder',$data);
    }
    function getProcessed() {
        $data['order']=Order::where('state',1)->orderBy('updated_at','desc')->get();
        return view('backend.order.processed',$data);
    }

    function Process($idOrder){
        $order=Order::find($idOrder);
        $order->state=1;
        $order->save();
        return redirect('/admin/order/processed');
    }
}
