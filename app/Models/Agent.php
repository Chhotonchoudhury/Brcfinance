<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_code',
        'name',
        'email',
        'phone',
        'gender',
        'date_of_birth',
        'aadhaar_number',
        'pan_number',
        'photo',
        'signature',
        'bank_name',
        'account_number',
        'ifsc_code',
        'branch_name',
        'address',
        'city',
        'state',
        'pincode',
        'branch_id',
        'joining_date',
        'commission_rate',
        'is_active',
        'documents',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    
    protected $casts = [
        'date_of_birth' => 'date',
        'joining_date' => 'date',
        'commission_rate' => 'decimal:2',
        'is_active' => 'boolean',
        'documents' => 'array', // JSON field casting
    ];

    /**
     * Generate a unique agent code when creating a new agent.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($agent) {
            // $agent->agent_code = 'AG' . str_pad(static::max('id') + 1, 5, '0', STR_PAD_LEFT);
            $agent->agent_code = 'AG' . (static::max('id') + 1);
        });
    }

    /**
     * Relationship with the Branch model.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
