<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;
class apiController extends Controller
{
    function getHome(request $r)
    {
     
        $data['prd_new']=Product::where('img','<>','no-img.jpg')->orderBy('id','desc')->take(4)->get();
        $data['prd_hot']=Product::where('img','<>','no-img.jpg')->where('featured',1)->orderBy('id','desc')->take(4)->get();
        
        return response()->json($data, 200);
    } 
    function getDetail($id_prd)
    {
        $prd=Product::find($id_prd);

        return response()->json($prd, 200);
    }

    function sendMail(request $r)
    {
        $data['email']=$r->email;
        Mail::send('Html.view', $data, function ($message) {
            $message->from('john@johndoe.com', 'John Doe');
            $message->sender('john@johndoe.com', 'John Doe');
            $message->to('john@johndoe.com', 'John Doe');
            $message->cc('john@johndoe.com', 'John Doe');
            $message->bcc('john@johndoe.com', 'John Doe');
            $message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Subject');
            $message->priority(3);
            $message->attach('pathToFile');
        });
        
        $message=[
            'error'=>'success'
        ];
        return response()->json( $message, 200);
    }

    function getPaginate()
    {
        $products=product::paginate(2);
        return response()->json( $products, 200);
    }
}
