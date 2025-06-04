<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizedCapital extends Model
{
    use HasFactory;
    // Specify the table name (optional if the table follows naming conventions)
    protected $table = 'authorized_capitals';

    // Fillable columns for mass assignment
    protected $fillable = [
        'total_shares',
        'nominal_value',
        'paid_up_capital',
        'issued_shares',
        'available_shares'
    ];

    // Cast decimal fields to ensure precision
    protected $casts = [
        'nominal_value' => 'decimal:2',
        'paid_up_capital' => 'decimal:2',
    ];

    // Custom method to calculate available shares
    public function calculateAvailableShares()
    {
        return $this->total_shares - $this->issued_shares;
    }

    // You can define additional methods or relationships here as needed
    
}
