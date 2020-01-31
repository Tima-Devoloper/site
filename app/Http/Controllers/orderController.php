<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\PositionName;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $orders = Order::where('status', Order::STATUS_ACTIVE)->orderBy('delivery_date', 'asc')->get();
        foreach($orders as $order)
        {
            $subOrdersGroupByOrderNumber = \App\SubOrder::where('order_number', $order->id)->get();
    
            $number    = 0;
            $orderMade = 0;
    
            foreach($subOrdersGroupByOrderNumber as $s_Order)
            {
                $number += $s_Order->number;
                $orderMade += $s_Order->orders_made;
    
            }
    
            echo $number , ' нужно сделать ' , $orderMade , ' сделано' ;
            
            if($number <= $orderMade)
            {
                \App\Order::where('id', $order->id )->update([
                    'status' => \App\Order::STATUS_DONE 
                    ]);
    
            }else
            {
                $i = 0;
            }

        };

        $orders = Order::where('status', Order::STATUS_ACTIVE)->orderBy('delivery_date', 'asc')->get();

        
        $shopper = new \App\Shoppper;
        return view('admin.tools.order.index',[
            'orders'   => $orders,
            'shopper'  => $shopper,
        ]
    );
    }



    public function indexReady()
    {

        $orders = Order::where('status', Order::STATUS_DONE)->orderBy('delivery_date', 'asc')->get();

        
        $shopper = new \App\Shoppper;
        return view('admin.tools.order.index',[
            'orders'   => $orders,
            'shopper'  => $shopper,
        ]
    );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Order::create( $request->all() );
       
        $order = Order::where('shopper_id',$request->shopper_id)->where('free',Order::STATUS_ACTIVE )->where('delivery_date', $request->delivery_date)->where('status',Order::STATUS_ACTIVE)->first();
       
        return view('admin.tools.subOrder.create',[
            'request'  => $request,
            'position' => PositionName::all(),
            'order'    => $order,
        ]);
    }

    //Store для Shopper

    public function storeShopper(Request $request)
    {
        $shopperId = \App\Shoppper::where('user_id',$request->shopper_id)->first();
        
        Order::create([
            'shopper_id'     => $shopperId->id,
            'delivery_date'  => $request->delivery_date,
        ]);
        $order = Order::where('shopper_id',$shopperId->id)->where('free',Order::STATUS_ACTIVE )->where('delivery_date', $request->delivery_date)->where('status',Order::STATUS_ACTIVE)->first();

        
        
        return view('shopper.tools.subOrder.create',[
            'request'  => $request,
            'position' => PositionName::all(),
            'order'    => $order,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.tools.order.show',
            [
                'order'     => $order,
                'subOrders' =>  \App\SubOrder::where('order_number' , $order->id)->get(),
                'positions' => new \App\PositionName,
            ]
        );
    }


    public function showShopper(Order $order)
    {
        return view('shopper.tools.order.show',
            [
                'order'     => $order,
                'subOrders' =>  \App\SubOrder::where('order_number' , $order->id)->get(),
                'positions' => new \App\PositionName,
            ]
        );
    }

    // Это функция написана для manageOfProduction . Чтобы admin и manageOfProduction 
    // не имели доступа к не своим функциям

    public function showManageOfProduction(Order $order)
    {

        return view('manageOfProduction.tools.order.show',
            [
                'order'     => $order,
                'subOrders' =>  \App\SubOrder::where('order_number' , $order->id)->get(),
                'positions' => new \App\PositionName,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function paramSearch(Request $request){
        
        // Зопрашиваем позиции подходящие под параметры
        $orders  = \App\Order::where('delivery_date','>=' , $request->min_date )
        ->where('delivery_date' , '<=' , $request->max_date)
        ->get();

        // Создаём массив для всех видов бауырсаков
        $fingers = [];

        $positions = \App\PositionName::all();

        foreach($positions as $position){
            
            $fingers[$position->id] = 0;
        
        };
        
        foreach($orders as $order){
            
            $subOrders = \App\SubOrder::where('order_number',$order->id)->get();

            foreach($subOrders as $subOrder ){
                
                    $fingers[$subOrder->position_id] +=  $subOrder->number;
            };

        };


        return view('admin.tools.order.paramSearch',[
            'fingers'   => $fingers,
            'positions' => $positions,
            'request'   => $request,
        ]);
    }
}
