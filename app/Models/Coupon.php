<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

 use SoftDeletes;

    protected $fillable = [
        'code',
        'discount_amount',
        'discount_type',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'discount_amount' => 'float',
        'expires_at' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Check if the coupon is valid (active and not expired)
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->is_active && (
            is_null($this->expires_at) || now()->lte($this->expires_at)
        );
    }

    /**
     * Get formatted discount (e.g., "$10" or "10%")
     *
     * @return string
     */
    public function formattedDiscount()
    {
        return $this->discount_type === 'percent'
            ? $this->discount_amount . '%'
            : '$' . number_format($this->discount_amount, 2);
    }
}