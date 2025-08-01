<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
  use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'company_name',
        'company_website',
        'gst',
        'account_holder_name',
        'bank_name',
        'account_number',
        'ifsc_code',
        'bank_address',
        'account_type',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'vendor', 'id');
    }

    // App\Models\Vendor.php

public function getTotalChargesAttribute()
{
    return collect([
        $this->parking_charges,
        $this->operational_charges,
        $this->transport,
        $this->dead_stock,
        $this->branding,
        $this->damage_and_shrinkege, // typo maintained for consistency
        $this->profit
    ])->map(function ($val) {
        return floatval($val);
    })->sum();
}


}
