<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubOrder extends Model
{
    
    
    protected $fillable = [
        'order_number', 'position_id','number',
    ];
}
