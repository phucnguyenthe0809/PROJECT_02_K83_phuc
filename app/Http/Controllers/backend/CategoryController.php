<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use Illuminate\Http\Request;
use App\models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function getCategory() {
        $data['categories']=Category::all();
        return view('backend.category.category',$data);
    }
    function postAddCategory(AddCategoryRequest $r){
        $cate=new Category;
        $cate->name=$r->name;
        $cate->slug=Str::slug($r->name, '-');
        $cate->parent=$r->parent;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã thêm thành công');

    }

    function getEditCategory($idCate) {
        $data['categories']=Category::all();
        $data['cate']=Category::find($idCate);
        return view('backend.category.editcategory',$data);
    }

    function postEditCategory($idCate,EditCategoryRequest $r){
        $cate=Category::find($idCate);
        $cate->name=$r->name;
        $cate->slug=Str::slug($r->name, '-');
        $cate->parent=$r->parent;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }

    function DelCategory($idCate){
        $cate=Category::find($idCate);
        $categories=Category::all();

        // foreach ($categories as $value) {
        //     if($value->parent==$cate->id){
        //         $value->parent=$cate->parent;
        //         $value->save();
        //     }
        // }

        //query update
            Category::where('parent',$cate->id)->update(["parent"=>"$cate->parent"]);
        $cate->delete();
        return redirect('/admin/category')->with('thongbao','Đã xóa thành công');
    }
}
