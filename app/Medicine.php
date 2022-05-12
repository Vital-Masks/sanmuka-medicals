<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public function images()
    {
        return $this->hasMany('App\MedicinesImages');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brands');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
