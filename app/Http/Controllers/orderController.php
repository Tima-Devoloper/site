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
        $shopper = new \App\Shoppper;
        return view('admin.tools.order.index',[
            'orders'   => Order::where('status', Order::STATUS_ACTIVE)->orderBy('delivery_date', 'asc')->get(),
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
        
        Order::create($request->all()
    );
    $order = Order::where('shopper',$request->shopper)->where('free',Order::STATUS_ACTIVE )->where('delivery_date', $request->delivery_date)->where('status',Order::STATUS_ACTIVE)->first();
        return view('admin.tools.subOrder.create',[
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
}