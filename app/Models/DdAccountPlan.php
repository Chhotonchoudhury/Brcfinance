<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DdAccountPlan extends Model
{
    use HasFactory;
    protected $table = 'dd_account_plans';
      // Define the guarded property to prevent mass assignment issues
    public $guarded = [];
    
} 
