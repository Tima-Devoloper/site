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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Группа роутов админ 
Route::group(
    [
        'prefix' => 'admin',
        'middleware' => 'auth',
    ],
    function () {

        //Главная страница админа
        Route::match(array('GET', 'POST'),'/', function() 
        {
            return view('admin/index',[
                'shoppers' => \App\Shoppper::all(),
            ]);
        })->name('admin.index');

        Route::resource('shopper','shopperController');

        // Это группа роутов ресурсного контроллера orderContrller
        Route::resource('order','orderController');

        // Это группа роутов ресурсного контроллера subOrderContrller
        Route::resource('subOrder','subOrderController');
    }
);
Route::group(
    [
        'prefix'     => 'manageofproduction',
        'middleware' => 'auth',
    ],
    function(){


        //Главная страница админа
        Route::match(array('GET', 'POST'),'/', function() 
        {
            return view('manageOfProduction/index',[
                'orders'   => \App\Order::where('status', \App\Order::STATUS_ACTIVE)->orderBy('delivery_date', 'asc')->get(),
                'shopper'  => new \App\Shoppper,
            ]);
        })->name('manageOfProduction.index');

        //Order routes
        Route::get('order/showManageOfProduction/{order}', 'orderController@showManageOfProduction')->name('order.showManageOfProduction');  
        
        //subOrder routes
        Route::get('subOrder/editManageOfProduction/{subOrder}/edit','subOrderController@editManageOfProduction')->name('subOrder.editManageOfProduction');
        Route::put('subOrder/updateManageOfProduction/{subOrder}','subOrderController@updateManageOfProduction')->name('subOrder.updateManageOfProduction');
    }
);