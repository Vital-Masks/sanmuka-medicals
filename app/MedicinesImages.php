<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicinesImages extends Model
{
    public function medicines()
    {
        return $this->belongsTo('App\Medicine');
    }
}
