<?php

use Illuminate\Support\Facades\Route;


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






Route::middleware(['nhanvien'])->group(function () {
    Route::get('/', function () {
        return view('admin.adminTemplate');
    });
    Route::group(['prefix' => 'promotion'], function () {
        Route::get('/add', 'PromotionController@add');
        Route::post('/insertProm', 'PromotionController@insertProm');
        Route::get('/delete/{id}', 'PromotionController@delete');
        Route::get('/edit/{id}', 'PromotionController@edit');
        Route::post('/edit/{id}', 'PromotionController@postEdit');
        Route::get('/getAll', 'PromotionController@getAll');
    });

    Route::group(['prefix' => 'shop'], function () {

        Route::get('/product/{id}','ShopController@productShop_admin');
        Route::get('/delete/{id}', 'ShopController@delete');
        Route::get('/edit/{id}', 'ShopController@edit');
        Route::post('/edit/{id}', 'ShopController@postEdit');
        Route::get('/getAll', 'ShopController@getAll');
    });


    Route::group(['prefix' => 'order'], function () {
        Route::get('getAll','OrderController@getAll');
        Route::get('deleteOrder/{id}','OrderController@deleteOrder_admin');
        Route::get('product/{id}','OrderController@productOrder');
        Route::get('orderItem/{id}','OrderController@orderItem');
        Route::get('UpdateOrderItem/{id}','OrderController@UpdateOrderItem');
        Route::post('postUpdateOrder/{id}','OrderController@postUpdateOrder');
    });

});

Route::middleware(['admin'])->group(function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('/getAll', 'CategoryController@getAll');
        Route::get('/delete/{id}', 'CategoryController@DeleteCategory');
        Route::get('/edit/{id}', 'CategoryController@edit');
        Route::post('/edit/{id}', 'CategoryController@EditCategory');
        Route::get('/add', 'CategoryController@add');
        Route::post('/add', 'CategoryController@AddCategory');
        Route::get('/searchID/{id}', 'CategoryController@searchID');
        Route::get('/searchSubcategory/{id}', 'CategoryController@searchSubcategory');
        Route::get('/product/{id}','CategoryController@product_admin');
    });
    
    
    Route::group(['prefix' => 'subcategory'], function () {
        Route::get('/getAll', 'SubCategoryController@getAll');
        Route::get('/delete/{id}', 'SubCategoryController@DeleteSubCategory');
        Route::get('/edit/{id}', 'SubCategoryController@edit');
        Route::post('/edit/{id}', 'SubCategoryController@EditSubCategory');
        Route::get('/add', 'SubCategoryController@add');
        Route::post('/add', 'SubCategoryController@AddSubCategory');
        Route::get('/searchID/{id}', 'SubCategoryController@searchID');
        Route::get('/product/{id}','SubCategoryController@product_admin');
    });
    
    
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/getAll', 'AdminController@getAll');
        Route::get('/delete/{id}', 'AdminController@DeleteAdmin');
        Route::get('/edit/{id}', 'AdminController@edit');
        Route::post('/edit/{id}', 'AdminController@EditAdmin');
        Route::get('/add', 'AdminController@add');
        Route::post('/add', 'AdminController@AddAdmin');
        Route::get('/searchID/{id}', 'AdminController@searchID');
        Route::get('login','AdminController@login');
        Route::post('login','AdminController@postLogin');
        Route::get('/logout_admin','AdminController@logout_admin');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/getAll', 'ProductController@getAll');
        Route::get('/capnhatkhuyenmai/{id}','ProductController@capnhatkhuyenmai');
        Route::post('update/{id}','ProductController@update');

    });

    




});
   
   
      
 

    

    
Route::get('time',function(){
    $timezone = date_default_timezone_get();
    echo "The current server timezone is: " . date("h:i:sa");
});


Route::get('login','AdminController@login');
Route::post('login','AdminController@postLogin');
Route::get('/logout_admin','AdminController@logout_admin');
Route::get('/back',function(){
    return redirect()-back();
});


Route::get('/noright',function(){
    return view('admin.NoRight');
});