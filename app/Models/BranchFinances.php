<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchFinances extends Model
{
    use HasFactory;
    public $guarded = [];
     // Relationship with the Branch model
     public function branch()
     {
         return $this->belongsTo(Branch::class);
     }
 
     // Add a method to calculate branch net balance
     public function calculateNetBalance()
     {
         return $this->total_deposits - $this->total_withdrawals + $this->total_income - $this->total_expenses;
     }
}
