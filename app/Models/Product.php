<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = ['name', 'description', 'short_description', 'slug', 'sku', 'status', 'stock', 'category_id', 'subcategory_id', 'vendor', 'purchase_price', 'discounted_rates','selling_price', 'main_image', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5','image_6', 'image_7', 'image_8', 'image_9', 'image_10', 'meta_description', 'meta_keywords', 'og_title', 'og_description', 'og_image', 'twitter_title', 'twitter_description', 'twitter_image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Define the relationship to Subcategory
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

      public function vendorDetails()
    {
        return $this->belongsTo(Vendor::class, 'vendor', 'id');
    }
}
