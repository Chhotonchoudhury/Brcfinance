<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    use HasFactory;
    public $guarded = [];

     // Polymorphic relation
     public function account()
     {
         return $this->morphTo(); // Assuming 'account' is the morphable model
     }
}
