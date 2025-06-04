<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FdPlan extends Model
{
    use HasFactory;

       // Fillable attributes for mass assignment
    protected $fillable = [
        'plan_code',
        'plan_name',
        'min_amount',
        'lockin_period',
        'annual_interest_rate',
        'senior_citizen_annual_interest_rate',
        'interest_lockin_period',
        'tenure_type',
        'tenure_value',
        'interest_payout',
        'cancellation_charge',
        'penal_charge',
        'active',
    ];
}
