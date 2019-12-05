<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Product;
use App\models\Category;

class ProductController extends Controller
{
    function getShop(request $r) {
        if ($r->start!="") {
            $data['products']=Product::where('img','<>','no-img.jpg')->whereBetween('price',[$r->start,$r->end])->orderBy('updated_at','desc')->paginate(6);
        } else {
            $data['products']=Product::where('img','<>','no-img.jpg')->orderBy('updated_at','desc')->paginate(6);
        }
        $data['categories']=Category::all();
        return view('frontend.product.shop',$data);
    }

    function getPrdCate($slug_cate,request $r){
        if ($r->start!="") {
            $data['products']=Category::where('slug',$slug_cate)->first()->product()
            ->where('img','<>','no-img.jpg')->whereBetween('price',[$r->start,$r->end])->paginate(6);

        } else {
            $data['products']=Category::where('slug',$slug_cate)->first()->product()->where('img','<>','no-img.jpg')->paginate(6);
        }


        $data['categories']=Category::all();
        return view('frontend.product.shop',$data);
    }

    function getDetail($slug_prd) {
        $arr=explode('-',$slug_prd);
        $id=array_pop($arr);
        $data['prd']=Product::find($id);
        $data['prd_new']=Product::where('img','<>','no-img.jpg')->orderBy('updated_at','desc')->take(4)->get();
        return view('frontend.product.detail',$data);
    }
}
