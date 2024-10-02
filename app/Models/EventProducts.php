<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventProducts extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'event_products';
}
