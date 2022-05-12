<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{
    protected $fillable = [
       'user_id', 'firstName', 'lastName', 'nic', 'phone', 'email',
        'address','city', 'zip', 'orderNotes',
        'subtotal','tax','total','deliverOption',
    ];


    // protected $fillable = ['orderNotes'];

    // public function checkoutproduct(){
    //     return $this->HasMany('App\checkout_product');
    // }

    // public function products(){
    //     return $this->belongsToMany('App\Product');
    // }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'checkout_products', 'checkout_id', 'product_id')->withPivot('qty','subtotal','size','updated_at');
    }

    public function order()
    {
        return $this->hasMany('App\Order');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
