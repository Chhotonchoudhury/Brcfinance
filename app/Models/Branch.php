<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_name', 'branch_code', 'opening_date', 'ifsc_code',
        'contact_email', 'contact_no', 'address1', 'address2',
        'city', 'state', 'pincode', 'country', 'notes', 
        'payment_service', 'transfer_service', 'status'
    ];
}
