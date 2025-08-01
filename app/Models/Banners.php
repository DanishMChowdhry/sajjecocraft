<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banners extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];
}
