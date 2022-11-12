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

Route::get('/', 'Main\DashboardController@index')->middleware('auth')->name('dashboard.index');

Route::middleware('auth')->namespace('Main')->group(function() {
    Route::prefix('/dashboard')->name('dashboard.')->group(function() {
        Route::get('/', 'DashboardController@index')->name('index');
        Route::post('/chart', 'DashboardController@chart')->name('chart');
    });

    Route::prefix('/category')->name('category.')->group(function() {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('/render', 'CategoryController@render')->name('render');
        Route::get('/create', 'CategoryController@create')->name('create');
        Route::post('/store', 'CategoryController@store')->name('store');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('edit');
        Route::post('/update', 'CategoryController@update')->name('update');
        Route::get('/delete/{id}', 'CategoryController@delete')->name('delete');
    });

    Route::prefix('/product')->name('product.')->group(function() {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('/render', 'ProductController@render')->name('render');
        Route::get('/create', 'ProductController@create')->name('create');
        Route::post('/store', 'ProductController@store')->name('store');
        Route::get('/edit/{id}', 'ProductController@edit')->name('edit');
        Route::post('/update', 'ProductController@update')->name('update');
        Route::get('/delete/{id}', 'ProductController@delete')->name('delete');
    });

    Route::prefix('/staff')->name('staff.')->group(function() {
        Route::get('/', 'StaffController@index')->name('index');
        Route::get('/render', 'StaffController@render')->name('render');
        Route::get('/create', 'StaffController@create')->name('create');
        Route::post('/store', 'StaffController@store')->name('store');
        Route::get('/edit/{id}', 'StaffController@edit')->name('edit');
        Route::post('/update', 'StaffController@update')->name('update');
        Route::get('/delete/{id}', 'StaffController@delete')->name('delete');
    });

    Route::prefix('/sale')->name('sale.')->group(function() {
        Route::get('/', 'SaleController@index')->name('index');
        Route::get('/search-product/{slug}', 'SaleController@search')->name('search');
        Route::get('/print/{start_date}/{end_date}', 'SaleController@print')->name('print');

        // detail
        Route::get('/detail', 'SaleController@detail')->name('detail');
        Route::get('/detail/render', 'SaleController@detailRender')->name('detail.render');
        Route::get('/detail/filter/{start_date}/{end_date}', 'SaleController@detailFilter')->name('detail.filter');
    });
    
    Route::prefix('/cart')->name('cart.')->group(function() {
        Route::post('/add', 'CartController@add')->name('add');
        Route::post('/update', 'CartController@update')->name('update');
        Route::post('/checkout', 'CartController@checkout')->name('checkout');
        Route::get('/remove/{id}', 'CartController@remove')->name('remove');
        Route::get('/check-cart', 'CartController@check')->name('check');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
