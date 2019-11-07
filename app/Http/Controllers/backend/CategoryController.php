<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function getCategory() {
        return view('backend.category.category');
    }

    function getEditCategory() {
        return view('backend.category.editcategory');
    }
}
