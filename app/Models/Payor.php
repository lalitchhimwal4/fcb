<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Payor extends Authenticatable
{
    use HasFactory;

    public function payor_profile(){
        return $this->belongsTo('App\Models\PayorInvoice');
    }
}
