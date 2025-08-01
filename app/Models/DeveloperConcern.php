<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperConcern extends Model
{
    use HasFactory;

      protected $fillable = [
        'enableMode',
        'msg'
    ];

}
