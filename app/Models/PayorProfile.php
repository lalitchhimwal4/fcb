<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayorProfile extends Model
{
    use HasFactory;

    public function payor(){
        return $this->hasMany('App\Models\Payor');
    }
}
