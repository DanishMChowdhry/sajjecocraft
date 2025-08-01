<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    // The name of the table associated with the model (optional if the name follows Laravel's naming convention)
    protected $table = 'invoices';

    // The attributes that are mass assignable
    protected $fillable = [
        'customer_name',
        'order_id',
        'product_json',
        'total',
        'status',
    ];

    // Cast product_json to an array (or object if preferred)
    protected $casts = [
        'product_json' => 'array',
    ];

    // Define the default value for 'status' if not provided
    protected $attributes = [
        'status' => 'pending',
    ];

    // If you want to hide sensitive data, for example, you can use the 'hidden' property.
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
