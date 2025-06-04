<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memeber extends Model
{
    use HasFactory;
    protected $table = 'memebers';


     // Define the mass-assignable attributes
     protected $fillable = [
        'application_number',
        'member_code',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'occupation',
        'annual_income',
        'monthly_income',
        'father_name',
        'mother_name',
        'husband_spouse',
        'marital_status',
        'enrollment_date',
        'ex_service_person',
        'email',
        'email_is_active',
        'mobile_number',
        'mobile_is_active',
        'aadhaar_number',
        'voter_id',
        'pan_number',
        'ration_card_number',
        'meter_number',
        'ci_number',
        'ci_relation',
        'dl_number',
        'bank_name',
        'bank_code',
        'account_type',
        'account_number',
        'ifsc_code',
        'branch_name',
        'correspondence_address_line1',
        'correspondence_address_line2',
        'para',
        'panchayat',
        'ward',
        'area',
        'landmark',
        'city',
        'state',
        'pincode',
        'country',
        'permanent_address',
        'permanent_city',
        'permanent_state',
        'permanent_pincode',
        'use_as_communication_address',
        'address_latitude',
        'address_longitude',
        'nominee_name',
        'nominee_relation',
        'nominee_mobile_number',
        'nominee_aadhaar_number',
        'nominee_voter_id',
        'nominee_pan_number',
        'nominee_ration_card_number',
        'nominee_address',
        'enable_sms_alert',
        'photo',
        'signature',
        'driving_license',
        'pan_card',
        'aadhar_card',
        'documents',
        'branch_id',
        'user_id',
        'employee_approval',
        'admin_approval',
        'status',
        'member_type', // Add member_type here
        'person_id', // Add role_id here
    ];

    // Define the cast for member_type to ensure it's treated as an enum
    protected $casts = [
        'member_type' => 'string',  // Cast it to string (or you can use custom casting if needed)
        'ex_service_person' => 'boolean',
    ];

    public static function getNextApplicationNumber()
    {
        // Get the last record by ID (assuming 'id' is an auto-increment column)
        $lastRecord = self::latest('id')->first();
    
        if ($lastRecord && $lastRecord->application_number) {
            // Extract the numeric part from the last application number
            $number = (int)preg_replace('/\D/', '', $lastRecord->application_number);
    
            // Increment the number
            $nextNumber = $number + 1;
    
            // Get the original length of the numeric part
            $originalLength = strlen(preg_replace('/\D/', '', $lastRecord->application_number));
    
            // Combine the prefix with the incremented, zero-padded number
            return 'RCAP' . str_pad($nextNumber, $originalLength, '0', STR_PAD_LEFT);
        }
    
        // Default application number if no records exist
        return 'RCAP0001';
    }





    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($member) {
            // Get the maximum ID and generate a unique 6-7 digit member code
            $member->member_code = 'M' . str_pad(static::max('id') + 1, 6, '0', STR_PAD_LEFT); // Pads to 7 digits

        });
    }

    // Define a relationship with the User model (assuming role_id links to the users table)
    public function user()
    {
        return $this->belongsTo(User::class, 'person_id'); // Assuming 'role_id' is the foreign key in the members table
    }

       /**
     * Relationship with the Branch model.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

}
