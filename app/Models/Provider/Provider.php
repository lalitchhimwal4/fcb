<?php

namespace App\Models\Provider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Provider extends Authenticatable
{
    use HasFactory;
    protected $guarded = [];

    public function claims()
    {
        return $this->hasMany(ProviderClaim::class, 'provider_id', 'id');
    }

    public function total_claim_amount()
    {
        $claims = $this->claims()->get();
        $total_claim_amount = 0;

        foreach ($claims as $claim) {
            $total_claim_amount += $claim->submitted_amount;
        }

        return $total_claim_amount;
    }
}
