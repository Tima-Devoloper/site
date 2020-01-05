<?php

namespace App\Http\Controllers;

use App\Shoppper;
use Illuminate\Http\Request;

class shopperController extends Controller
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
    public function create()
    {
        return view('admin.tools.shopper.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Shoppper::create($request->all());

        return redirect()->route('admin.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shoppper  $shoppper
     * @return \Illuminate\Http\Response
     */
    public function show(Shoppper $shoppper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shoppper  $shoppper
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Shoppper $shoppper)
    {
        return view('admin.tools.shopper.edit',[
            'shopper' => $shoppper,
            'request' => $request,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shoppper  $shoppper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shoppper $shoppper)
    {
        $shoppper->where('id',$request->id)->update([
            'name' => $request->name,
            'adress' => $request->adress,
        ]);


        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shoppper  $shoppper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shoppper $shoppper)
    {
        //
    }
}
