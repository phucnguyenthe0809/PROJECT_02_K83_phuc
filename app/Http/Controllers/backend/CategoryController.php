<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
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
        $cate->parent=$r->category;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã thêm thành công');

    }

    function getEditCategory() {
        return view('backend.category.editcategory');
    }
}
