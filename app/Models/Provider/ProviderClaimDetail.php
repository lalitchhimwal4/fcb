<?php

namespace App\Models\Provider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderClaimDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_claim_id', 'service_code', 'description', 'patient_pays_amount', 'submitted_amount', 'fcb_contracted_rate',
    ];

    public function claim()
    {
        return $this->belongsTo(ProviderClaim::class, 'provider_claim_id', 'id');
    }
}
