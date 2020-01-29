<?php

namespace App\Http\Controllers;
use App\Mail\mailShipped;
use App\mail;
use Illuminate\Http\Request;

class mailController extends Controller
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

    public function send_form(Request $request)
    {
        $name   = $request->name;
        $email  = $request->email;
        $msg    = $request->msg;
        $number = $request->number;

        \Mail::to('Ayim.95@mail.ru')->send(new mailShipped($name,$email,$msg,$number)); 
        \Mail::to('too_elim-ai@mail.ru')->send(new mailShipped($name,$email,$msg,$number)); 
        return redirect('/');
    }

    public static function send_form_shopper($order)
    { 
        // \Mail::to('Ayim.95@mail.ru')->send(new mailShipped($name,$email,$msg,$number)); 
        \Mail::to('too_elim-ai@mail.ru')->send(new mailShipped($order)); 
        return redirect('/');
    }

    //Фунуция для отправка сообщения send
    public function send()
    {
        \Mail::send(['text' => 'mail'],['name', 'Tima'], function($message)
        {
            $message->to('too_katto@mail.ru','To Ayim')->subject('Test mail');
            $message->from('too_elim-ai@mail.ru','"Elim-ai" LLC');
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Application::create($request->all());
        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function show(mail $mail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function edit(mail $mail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mail $mail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function destroy(mail $mail)
    {
        //
    }
}
