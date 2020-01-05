<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoppper extends Model
{
    protected $fillable = [
        'name', 'adress',
    ];
}
