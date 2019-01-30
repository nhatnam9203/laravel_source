<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




Route::group(['prefix' => 'customer'], function () {
    Route::post('/register', 'CustomerController@register');
    Route::post('/login', 'CustomerController@login');
});

Route::group(['prefix' => 'shop'], function () {
    Route::post('/register', 'ShopController@register');
    Route::post('/login', 'ShopController@login');
    Route::get('/productShop/{id}','ShopController@productShop');
});

Route::group(['prefix' => 'category'], function () {
    Route::get('/getAll', 'CategoryController@api_getAll');
    Route::get('/getSubCategory/{id}','CategoryController@api_getSubCategory_By_CategoryID');
    Route::get('/search/{id}','CategoryController@api_search');
    Route::get('productCategory/{id}','CategoryController@productCategory');
 
});

 Route::group(['prefix' => 'subcategory'], function () {
    Route::get('/getAll', 'SubCategoryController@api_getAll');
    Route::get('/getSubCategoryByCategoryID/{category_id}','SubcategoryController@api_getSubcategoryByCategoryID');

 });

Route::group(['prefix' => 'product'], function () {
    Route::get('/productKhuyenMai', 'ProductController@productKhuyenmai');
    Route::post('/add', 'ProductController@api_add');
    Route::get('getAll','ProductController@api_getAll');
    Route::post('/search','ProductController@api_searchProduct');
    Route::get('searchID/{id}','ProductController@api_searchID');
    Route::get('searchProductByShopID/{idShop}','ProductController@api_searchProductByShopID');
    Route::get('delete/{id}','ProductController@api_deleteProductByID');
    Route::get('time','ProductController@time');

});

Route::group(['prefix' => 'order'], function () {
    Route::post('insertOrder','OrderController@api_insertOder');
    Route::get('findAllProductAreOrdered/{idShop}','OrderController@findAllProductAreOrdered');
    Route::get('findOrderByCustomer/{idCustomer}','OrderController@findOrderByCustomer');
    Route::get('findOrderItem/{idOrder}','OrderController@findOrderItem');
    Route::get('deleteOrder/{id}','OrderController@deleteOrder');
    Route::get('updateOrder/{id}','OrderController@api_updateOrder');
    Route::post('updateOrderItem/{id}','OrderController@api_updateOrderItem');
    Route::get('deleteOrderItem/{id}','OrderController@api_deleteOrderItem');
});


Route::group(['prefix' => 'promotion'], function () {
    Route::get('getAll','PromotionController@api_getAll');
    Route::post('checkItem','PromotionController@checkItemPromotion');
    Route::post('checkPromotion','PromotionController@api_checkPromotion');
});


