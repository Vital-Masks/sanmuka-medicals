<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'id','Name', 'Email', 'Subject', 'Message', 'Viewed'
    ];
}
