<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $fillable = [
        'size', 'price', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Products');
    }

    public function presentPrice()
    {
        return 'LKR ' . number_format($this->price / 100, 2);
    }
}
