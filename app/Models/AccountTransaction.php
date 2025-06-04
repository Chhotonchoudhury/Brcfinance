<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTransaction extends Model
{
    use HasFactory;
    public $guarded = [];

    // Relationship with SavingsAccount or other account types
    public function account()
    {
        return $this->morphTo(); // Polymorphic relationship
    }

    public function transaction()
    {
        return $this->morphTo();
    }
    
    
      public function producedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function getBranchIdAttribute()
    {
        if ($this->transaction) {
            // If the related model has a branch() relation, return its branch_id
            return $this->transaction->branch_id ?? null;
        }
        return null;
    }
}
