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
        Route::get('edit/{idUser}', 'backend\UserController@getEditUser');
        Route::post('edit/{idUser}', 'backend\UserController@postEditUser');
        Route::get('del/{idUser}', 'backend\UserController@delUser');
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

//QUUERY BUILDER

Route::group(['prefix' => 'query'], function () {

    //thêm dữ liệu database
    Route::get('insert', function () {
        //thêm 1 bản ghi
        DB::table('users')->insert([
            "email"=>"A@gmail.com",
            "password"=>"123456",
            "full"=>"Nguyen Van A",
            "address"=>"ha noi",
            "phone"=>"123456789",
            "level"=>"1"
        ]);
        //thêm nhiều bản ghi
        DB::table('users')->insert([
            ["email"=>"B@gmail.com","password"=>"123456","full"=>"Nguyen Van B","address"=>"ha noi","phone"=>"123456780","level"=>"0"],
            ["email"=>"C@gmail.com","password"=>"123456","full"=>"Nguyen Van C","address"=>"ha noi","phone"=>"123456781","level"=>"0"],
            ["email"=>"D@gmail.com","password"=>"123456","full"=>"Nguyen Van D","address"=>"ha noi","phone"=>"123456782","level"=>"0"],
            ["email"=>"E@gmail.com","password"=>"123456","full"=>"Nguyen Van E","address"=>"ha noi","phone"=>"123456783","level"=>"0"]
        ]);
    });

    //sửa dữ liệu database
    Route::get('update', function () {
        DB::table('users')->where('id',2)->update(["address"=>"bac giang","phone"=>"0987654321"]);
    });

    //xóa dữ liệu
    Route::get('del', function () {
        //xóa 1 bản ghi
        // DB::table('users')->where('id',2)->delete();

        //xóa tất cả bản ghi
        DB::table('users')->delete();
    });


    //nâng cao
//tương tác với các bản ghi

//lấy ra bản ghi
//sử get() hoặc first()
    Route::get('get', function () {
        //lấy nhiều bản ghi
        // $user=DB::table('users')->get();
        // dd($user);

        //lấy bản ghi đầu tiên
        // $user=DB::table('users')->first();
        // dd($user);

        //lấy bản ghi theo id
        $user=DB::table('users')->find(8);
        dd($user);
    });

    //lấy bản ghi theo điều kiện
    Route::get('where', function () {
    //where
        // $user=DB::table('users')->where('phone','123456789')->get();
        // dd($user);
        // $user=DB::table('users')->where('id','<>','7')->get();
        // dd($user);

    //where-and
        // $user=DB::table('users')->where('id','>','7')->where('level',1)->get();
        // dd($user);

    //where-or
        // $user=DB::table('users')->where('id','>','9')->orwhere('id','<',7)->get();
        // dd($user);

    //whereBetween
        $user=DB::table('users')->whereBetween('id',[7,9])->get();
        dd($user);
    });

    //sắp xếp orderBy()
    Route::get('order-by', function () {
        $user=DB::table('users')->orderBy('id','desc')->get();
        dd($user);
    });

    //lấy một số lượng bản ghi xác định
    Route::get('take', function () {
        $user=DB::table('users')->take(3)->get();
        dd($user);
    });

    //bỏ qua bản ghi skip()
    Route::get('bo-qua', function () {
        $user=DB::table('users')->skip(2)->take(3)->get();
        dd($user);
    });












});






