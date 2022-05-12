<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'user_id', 'firstName', 'lastName', 'nic', 'phone', 'email',
         'address', 'orderNotes',
         'image'
     ];
     
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
