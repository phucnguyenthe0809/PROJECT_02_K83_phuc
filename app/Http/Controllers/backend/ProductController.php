<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use Illuminate\Http\Request;
use App\models\Product;
use App\models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    function getProduct() {
        $data['products']=Product::paginate(3);
        return view('backend.product.listproduct',$data);
    }
    function getAddProduct() {
        $data['categories']=Category::all();
        return view('backend.product.addproduct',$data);
    }

    function postAddProduct(AddProductRequest $r) {
        $prd=new Product;
        $prd->code=$r->code;
        $prd->name=$r->name;
        $prd->slug=Str::slug($r->name, '-');
        $prd->price=$r->price;
        $prd->featured=$r->featured;
        $prd->state=$r->state;
        $prd->info=$r->info;
        $prd->describe=$r->describe;

        if($r->hasFile('img')){
            $file=$r->img;
            $fileName=Str::slug($r->name, '-').'.'.$file->getClientOriginalExtension();
            $file->move('backend/img',$fileName);
            $prd->img=$fileName;
        }else{
            $prd->img='no-img.jpg';
        }

        $prd->category_id=$r->category;
        $prd->save();
        return redirect('/admin/product')->with('thongbao','Đã thêm thành công');
    }

    function getEditProduct($idPrd) {
        $data['prd']=Product::find($idPrd);
        $data['categories']=Category::all();
        return view('backend.product.editproduct',$data);
    }
    function postEditProduct($idPrd,request $r){
        $prd=Product::find($idPrd);
        $prd->code=$r->code;
        $prd->name=$r->name;
        $prd->slug=Str::slug($r->name, '-');
        $prd->price=$r->price;
        $prd->featured=$r->featured;
        $prd->state=$r->state;
        $prd->info=$r->info;
        $prd->describe=$r->describe;

        if($r->hasFile('img')){
            if ($prd->img!='no-img.jpg') {
                unlink('backend/img/'.$prd->img);
            }
            $file=$r->img;
            $fileName=Str::slug($r->name, '-').'.'.$file->getClientOriginalExtension();
            $file->move('backend/img',$fileName);
            $prd->img=$fileName;
        }

        $prd->category_id=$r->category;
        $prd->save();
        return redirect('/admin/product')->with('thongbao','Đã sửa thành công');
    }

    function DelProduct(){

    }
}
