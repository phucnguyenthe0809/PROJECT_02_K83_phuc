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

use Illuminate\Routing\RouteGroup;

Route::get('', 'frontend\HomeController@getIndex');
Route::get('contact', 'frontend\HomeController@getContact');
Route::get('about', 'frontend\HomeController@getAbout');

//cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('', 'frontend\CartController@getCart');
});

//checkout
Route::group(['prefix' => 'checkout'], function () {
    Route::get('', 'frontend\CheckoutController@getCheckout');
    Route::post('', 'frontend\CheckoutController@postCheckout');
    Route::get('complete', 'frontend\CheckoutController@getComplete');
});

//product
Route::group(['prefix' => 'product'], function () {
    Route::get('shop','frontend\ProductController@getShop' );
    Route::get('detail', 'frontend\ProductController@getDetail');
});




//------------------------
//BACKEND
//login
Route::get('login', 'backend\LoginController@getLogin');
Route::post('login', 'backend\LoginController@postLogin');

Route::group(['prefix' => 'admin'], function () {
    //admin
    Route::get('', 'backend\IndexController@getIndex');

    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('', 'backend\CategoryController@getCategory');
        Route::post('', 'backend\CategoryController@postAddCategory');
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
        Route::post('add', 'backend\ProductController@postAddProduct');
        Route::get('edit','backend\ProductController@getEditProduct' );
    });

    //user
    Route::group(['prefix' => 'user'], function () {
        Route::get('', 'backend\UserController@getUser');
        Route::get('add','backend\UserController@getAddUser' );
        Route::post('add','backend\UserController@postAddUser' );
        Route::get('edit', 'backend\UserController@getEditUser');
    });

});



//---LÝ THUYẾT-----

//SCHEMA

Route::group(['prefix' => 'schema'], function () {

    //tạo bảng
    Route::get('create', function () {
        Schema::create('users', function ($table) {
            $table->bigIncrements('id');     //khóa chính, tự tăng ,bigInt, unsigned
            $table->string('name');          // varchar
            $table->string('address', 100)->nullable();// varchar(100) , có thể null
            $table->timestamps();            // trường thời gian created_at , updated_at
        });

    //tạo bảng chứa khóa ngoại
    // bảng chứa khóa ngoại(bảng phụ) phải tạo sau bảng chứa khóa chính (bảng chính)
        Schema::create('post', function ($table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    });



//sửa bảng
    Route::get('edit', function () {
        //sửa tên bảng
        // Schema::rename('users', 'thanh-vien');    //sửa tên bảng từ users thành thanh-vien

        //xóa cột trong bảng
        Schema::table('thanh-vien', function ($table) {
            $table->dropColumn('address');        // xóa cột address
        });
    });

//xóa bảng
    Route::get('del', function () {
        Schema::dropIfExists('thanh-vien');

    });


//tương tác với cột trong bảng
    //cần cập nhật doctrine
    //composer require doctrine/dbal

Route::get('edit-col', function () {


    Schema::table('users', function ($table) {
        //sửa cột
        // $table->string('name',50)->nullable()->change();

        //thêm cột
        // $table->boolean('level')->default(0);

        //thêm cột ở vị trí xác định
        $table->boolean('level')->default(0)->after('name');   //thêm cột ngay sau cột name

        //xóa cột
        // $table->dropColumn('level');

    });



});





});



