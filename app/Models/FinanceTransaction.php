<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceTransaction extends Model
{
    use HasFactory;
    public $guarded = [];

     // Relationship with the Branch model
     public function branch()
     {
         return $this->belongsTo(Branch::class);
     }
 
     // Relationship with the User model (Processed by)
     public function processedBy()
     {
         return $this->belongsTo(User::class, 'processed_by');
     }
}
