<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//FRONTEND
Route::get('about', function () {
    echo 'about';
});
Route::get('contact', function () {
    echo 'contact';
});
Route::get('', function () {
    echo 'index';
});

//cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('', function () {
        echo 'cart';
    });
});

//checkout
Route::group(['prefix' => 'checkout'], function () {
    Route::get('', function () {
        echo 'checkout';
    });
    Route::get('complete', function () {
        echo 'complete';
    });
});

//product
Route::group(['prefix' => 'product'], function () {
    Route::get('shop', function () {
        echo 'shop';
    });
    Route::get('detail', function () {
        echo 'detail';
    });
});




//------------------------
//BACKEND
//login
Route::get('login', 'backend\LoginController@getLogin');

Route::group(['prefix' => 'admin'], function () {
    //admin
    Route::get('', 'backend\IndexController@getIndex');

    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('', 'backend\CategoryController@getCategory');
        Route::get('edit','backend\CategoryController@getEditCategory');
    });

    //order
    Route::group(['prefix' => 'order'], function () {
        Route::get('', 'backend\OrderController@getOrder');
        Route::get('detail', 'backend\OrderController@getDetail');
        Route::get('processed', 'backend\OrderController@getProcessed');
    });

    //product
    Route::group(['prefix' => 'product'], function () {
        Route::get('', 'backend\ProductController@getProduct');
        Route::get('add', 'backend\ProductController@getAddProduct');
        Route::get('edit','backend\ProductController@getEditProduct' );
    });

    //user
    Route::group(['prefix' => 'user'], function () {
        Route::get('', 'backend\UserController@getUser');
        Route::get('add','backend\UserController@getAddUser' );
        Route::get('edit', 'backend\UserController@getEditUser');
    });

});





