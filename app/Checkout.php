<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    public function user()
    {
        return $this->belongsTo(Cart::class);
    }
}
