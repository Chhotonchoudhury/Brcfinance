<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareRange extends Model
{
    use HasFactory;
     // Define the table name (optional if the table name matches the model name)
     protected $table = 'share_ranges';

     // Define the fillable fields (columns that can be mass assigned)
     protected $fillable = [
         'user_type',
         'num_shares',
         'min_shares',
         'max_shares',
         'active',
     ];
 
     // You can also define casts if you need specific data types for columns
     protected $casts = [
         'active' => 'boolean', // Ensures active is always treated as a boolean
     ];
 
     // If you want to automatically handle timestamps, you can leave this enabled
     public $timestamps = true; // Default value, you can omit this if using default behavior
}
