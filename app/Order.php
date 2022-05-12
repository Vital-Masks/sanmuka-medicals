<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function checkout(){
        return $this->belongsTo('App\checkout');
    }

    public function OrderProduct(){
        return $this->belongsToMany('App\Product');
    }
}
