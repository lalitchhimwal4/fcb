<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $fillable=['name','roleid'];

    public function role_users()
    {
    	return $this->hasMany('App\Models\User','roleid','roleid');
    }
}
