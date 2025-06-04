<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingAccountPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_code',
        'plan_name',
        'min_opening_balance',
        'min_average_balance',
        'annual_interest_rate',
        'senior_citizen_annual_interest_rate',
        'interest_payout',
        'lock_in_amount',
        'min_monthly_avg_balance_charge',
        'sms_charge_frequency',
        'sms_charge',
        'card_charges_frequency',
        'card_charge',
        'free_ifsc_collection_per_month',
        'active', // Add the 'active' field to the fillable array
    ];

}
