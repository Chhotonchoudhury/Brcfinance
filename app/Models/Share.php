<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;

    protected $fillable = [
        'shareholder_type', 'shareholder_id','share_range_start', 'share_range_end', 
        'nominal_value', 'number_of_shares', 'purchase_price','date', 'share_type', 'status'
    ];

    // Define the polymorphic relationship to users and members
    public function shareholder()
    {
        return $this->morphTo();
    }
}
