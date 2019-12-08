<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use Cart;
use App\models\Order;
use App\models\ProductOrder;

class CheckoutController extends Controller
{
    function getCheckout() {
        $data['total']=Cart::total(0,"",".");
        $data['product']=Cart::content();
        return view('frontend.checkout.checkout',$data);
    }

    function postCheckout(CheckoutRequest $r) {
        $order=new Order;
        $order->full=$r->full;
        $order->address=$r->address;
        $order->email=$r->phone;
        $order->phone=$r->email;
        $order->total=Cart::total(0,"","");
        $order->state=2;
        $order->save();
        foreach (Cart::content() as $row) {
            $prd=new ProductOrder;
            $prd->code=$row->id;
            $prd->name=$row->name;
            $prd->price=$row->price;
            $prd->qty=$row->qty;
            $prd->img=$row->options->img;
            $prd->order_id=$order->id;
            $prd->save();
        }
        Cart::destroy();
        return redirect('checkout/complete/'.$order->id);
    }

    function getComplete($idOrder) {
        $data['order']=Order::find($idOrder);
        return view('frontend.checkout.complete',$data);
    }
}
