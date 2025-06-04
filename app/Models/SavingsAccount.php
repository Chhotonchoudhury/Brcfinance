<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsAccount extends Model
{
    use HasFactory;
    public $guarded = [];

    // protected $table = 'savings_accounts';
    // Automatically eager load these relationships
    protected $with = ['member', 'branch', 'savingsPlan' , 'nominee', 'transactions'];

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
     public function savingsPlan()
     {
         return $this->belongsTo(SavingAccountPlan::class);
     }
 
     // Relationship with the Nominee model
     public function nominee()
     {
         return $this->morphOne(Nominee::class, 'account');
     }

     public function transactions()
     {
         return $this->morphMany(AccountTransaction::class, 'transaction');
     }


    // Event listener for generating unique account number
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($account) {
            // Get the maximum ID from the SavingsAccount table
            $maxId = SavingsAccount::max('id');
            
            // Generate the account number based on the max ID or any other logic
            $accountNumber = 'SA' . str_pad($maxId + 1, 6, '0', STR_PAD_LEFT);
            
            // Assign the generated account number
            $account->account_number = $accountNumber;
        });
    }
}
