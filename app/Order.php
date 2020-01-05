<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{

    use Notifiable;
    
    protected $fillable = [
        'delivery_date', 'shopper',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_DONE = 0;
}
