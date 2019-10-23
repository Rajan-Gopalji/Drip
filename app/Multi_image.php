<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multi_image extends Model
{
    protected $table = "multi_image";
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }
}
