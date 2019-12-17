<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Product;
use Mail;

class HomeController extends Controller
{
    function getIndex() {
        $data['prd_new']=Product::where('img','<>','no-img.jpg')->orderBy('id','desc')->take(4)->get();
        $data['prd_hot']=Product::where('img','<>','no-img.jpg')->where('featured',1)->orderBy('id','desc')->take(4)->get();
        return view('frontend.index',$data);
    }

    function getContact() {
        return view('frontend.contact');
    }

    function getAbout() {
        return view('frontend.about');
    }

    function sendMail(request $r)
    {
      $data['email']= $r->email;
        Mail::send('mail', $data, function ($message) use ($data) {
            $message->from('phucnguyenthe0809@gmail.com', 'VIETPRO');
            $message->to($data['email'], 'Khách hàng');
            $message->subject('Subject');
        });
    }
}
