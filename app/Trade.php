<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = [
        'user_id_tradee', 'user_id_trader', 'post_id_tradee', 'post_id_trader', 'accepts'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
