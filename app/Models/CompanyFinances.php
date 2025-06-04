<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyFinances extends Model
{
    use HasFactory;
    public $guarded = [];

     // Add any financial calculation methods if needed
     public function calculateNetBalance()
     {
         return $this->total_deposits - $this->total_withdrawals + $this->total_income - $this->total_expenses;
     }
}
