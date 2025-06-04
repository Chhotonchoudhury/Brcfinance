<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;


     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees';
    public $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Generate a unique employee code when a new employee is created
        static::creating(function ($employee) {
            $employee->employee_code = 'EM' . str_pad(static::max('id') + 1, 4, '0', STR_PAD_LEFT);
            // $employee->employee_code = 'EM' . str_pad(static::max('id') + 1);
            // $member->member_code = 'M' . str_pad(static::max('id') + 1, 6, '0', STR_PAD_LEFT); // Pads to 7 digits
        });
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class ,'branch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
