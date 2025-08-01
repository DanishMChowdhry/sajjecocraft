<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerEnquiry extends Model
{
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'customer_id',
        'enquiry_id',
        'product_id',
        'product_name',
        'product_image',
        'price',
        'quantity',
        'subtotal',
    ];

    // Define the table name if it's not following Laravel's default pluralization rule
    protected $table = 'customer_enquiries';
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id'); // Assumes 'customer_id' is the foreign key
    }
    /**
     * Get grouped enquiries by enquiry_id
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getGroupedEnquiries()
    {
        // Order by most recent created_at timestamp
        $enquiries = self::orderBy('created_at', 'desc')->get();

        // Group the enquiries by 'enquiry_id'
        return $enquiries->groupBy('enquiry_id');
    }


    /**
     * Helper method to retrieve items (products) for each enquiry.
     * Since you're using the same model for items and enquiries, no separate model is needed.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItems()
    {
        // If each enquiry is an item, just return this enquiry's 'items' (all rows with the same enquiry_id)
        return self::where('enquiry_id', $this->enquiry_id)->get();
    }
}
