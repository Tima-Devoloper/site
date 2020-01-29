<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class mailShipped extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        
        $this->order   = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        // Содержание письма    
        return $this->from('too_elim-ai@mail.ru')->view('mail')->with([
            'order'     => $this->order,
            'subOrders' => \App\SubOrder::where('order_number' ,  $this->order->id)->get(),
            'positions' => new \App\PositionName,
        ])->subject('Новое сообщение');
        ;
    }
}
