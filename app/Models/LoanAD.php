<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanAD extends Model
{
    use HasFactory;
    public $guarded = [];

    // Relationship with the Member model
    public function member()
    {
        return $this->belongsTo(Memeber::class);
    }

    // Relationship with the Branch model
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Relationship with the SavingsPlan model
    public function Plan()
    {
        return $this->belongsTo(LoanAgainstDepositPlan::class);
    }
    
     public function associated()
    {
        return $this->belongsTo(User::class , 'associate_id');
    }

    public function applicant()
    {
        return $this->belongsTo(User::class , 'application_by');
    }

    public function applicationApprovedBy()
    {
        return $this->belongsTo(User::class , 'application_approved_by');
    }

    public function applicationRejectedBy()
    {
        return $this->belongsTo(User::class, 'application_rejected_by');
    }


    public function marketcode()
    {
        return $this->belongsTo(MarketCode::class , 'marketcode_id');
    }

    
}
