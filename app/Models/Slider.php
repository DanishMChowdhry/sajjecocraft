<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title', 'description', 'tag', 'cta_label', 'cta_url', 'image', 'order', 'status'];

}
