<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    // Alternatively, you can use guarded
    protected $guarded = []; // Disallow all mass assignment
}
