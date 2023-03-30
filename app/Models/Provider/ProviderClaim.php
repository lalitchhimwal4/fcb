<?php

namespace App\Models\Provider;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderClaim extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number', 'provider_id', 'member_id', 'patient_pays_amount', 'submitted_amount', 'fcb_contracted_rate', 'processed_date', 'failed_payment',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function claimDetails()
    {
        return $this->hasMany(ProviderClaimDetail::class, 'provider_claim_id', 'id');
    }
}
