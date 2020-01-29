<?php

namespace App\Http\Controllers;

use App\SubOrder;
use Illuminate\Http\Request;

class subOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.tools.subOrder.create',[
            'request' => $request,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        for($i=0; $i< $request->summ ; $i++)
        {
            $number = '1000' + $i;
            print_r($number);
            SubOrder::create([
                'order_number' => $request->order_number,
                'position_id'  => $request->$i , //Свойство от 0 до 1000 являюстся свойствами position_id 
                'number'       => $request->$number,// Свойства от 1000 и дальше являются свойствами number
            ]); 

        }

        // Здесь мы меняем поле free  Order-а к которомы мы привязоны на \App\Order::STATUS_DONE
        //  чтобы в дальнейшем к нему не могли другие привязаться
        \App\Order::where('id',$request->order_number)->update([
            'free' => \App\Order::STATUS_DONE,
        ]);

        return redirect()->route('admin.index');
    }
    

    public function storeShopper(Request $request)
    {

        
        for($i=0; $i< $request->summ ; $i++)
        {
            $number = '1000' + $i;
            print_r($number);
            SubOrder::create([
                'order_number' => $request->order_number,
                'position_id'  => $request->$i , //Свойство от 0 до 1000 являюстся свойствами position_id 
                'number'       => $request->$number,// Свойства от 1000 и дальше являются свойствами number
            ]); 

        }

        // Здесь мы меняем поле free  Order-а к которомы мы привязоны на \App\Order::STATUS_DONE
        //  чтобы в дальнейшем к нему не могли другие привязаться
        \App\Order::where('id',$request->order_number)->update([
            'free' => \App\Order::STATUS_DONE,
        ]);
        
        $orderMailShopper = \App\Order::where('id',$request->order_number)->first();

        \App\Http\Controllers\mailController::send_form_shopper($orderMailShopper);

        return redirect()->route('shopper.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\SubOrder  $subOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SubOrder $subOrder)
    {
        print_r($subOrder);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubOrder  $subOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SubOrder $subOrder)
    {
        return view('admin.tools.subOrder.edit',[
            'subOrder' => $subOrder,
        ]);
    }

    // Это функция написана для manageOfProduction . Чтобы admin и manageOfProduction 
    // не имели доступа к не своим функциям

    public function editManageOfProduction(SubOrder $subOrder)
    {
        return view('manageOfProduction.tools.subOrder.edit',[
            'subOrder' => $subOrder,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubOrder  $subOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubOrder $subOrder)
    {
        $subOrder->update([
            'number' => $request->number,
        ]);

        return redirect()->route('order.index');
    }


    public function updateManageOfProduction(Request $request, SubOrder $subOrder)
    {

        $subOrder::where('id',$request->id)->update([
            'orders_made' => $request->orders_made,
        ]);
        
        $subOrderThis = $subOrder::where('id',$request->id)->first();

        $subOrdersGroupByOrderNumber = $subOrder::where('order_number', $subOrderThis->order_number)->get();

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
            \App\Order::where('id', $subOrderThis->order_number )->update([
                'status' => \App\Order::STATUS_DONE 
                ]);

        }else
        {
            $i = 0;
        }

        return redirect()->route('manageOfProduction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubOrder  $subOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubOrder $subOrder)
    {
        //
    }
}
