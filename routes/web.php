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


Route::get('send','mailController@send');
// Роут для отправки сообщения по почте mail.ru от too_elim-ai@mail.ru к too_elim-ai@mail.ru то есть самой себе
Route::match(array('GET', 'POST'),'send-mail','mailController@send_form_shopper')->name('send_mail.shopper');


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

        Route::get('order/ready','orderController@indexReady')->name('order.indexReady');

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



Route::group(
    [
        'prefix'     => 'shopper',
        'middleware' => 'auth',
    ],
    function(){


        //Главная страница админа
        Route::match(array('GET', 'POST'),'/', function() 
        {
            return view('shopper/index',[
                'orders'   => new \App\Order,
            ]);
        })->name('shopper.index');

        //Order routes
        Route::post('order/storeShopper', 'orderController@storeShopper')->name('order.storeShopper'); 
        Route::get('order/showShopper/{order}','orderController@showShopper')->name('order.showShopper'); 
        
        //subOrder routes
        Route::get('subOrder/editManageOfProduction/{subOrder}/edit','subOrderController@editManageOfProduction')->name('subOrder.editManageOfProduction');
        Route::put('subOrder/updateManageOfProduction/{subOrder}','subOrderController@updateManageOfProduction')->name('subOrder.updateManageOfProduction');
        Route::post('subOrder/storeShopper','subOrderController@storeShopper')->name('subOrder.storeShopper');
    }
);