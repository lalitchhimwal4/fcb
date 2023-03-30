<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuredProfile extends Model
{
    use HasFactory;

    public function member()
    {
        return $this->hasMany('App\Models\Member');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'insured_profile_id', 'id');
    }
}

