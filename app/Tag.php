<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function order(){
        $this->belongsToMany('App\Order');
    }

    public function product(){
        $this->belongsToMany('App\Product');
    }
}
