<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RdAccountPlan extends Model
{
    use HasFactory;
    protected $table = 'rd_account_plans';
       // Define the guarded property to prevent mass assignment issues
    public $guarded = [];
}
